<?php
	
	ini_set('display_errors', 1); // bu kod hata msajlarini ekrana yazdirir.
	ini_set('display_startup_errors', 1);//php baslatilirken olusan hatalari gösterir.
	error_reporting(E_ALL);// tüm hata türlerini gösterir.

class database {
  
    private $servername = "213.238.183.60";
    private $username = "orakoglu_gulsen";
    private $password = "Gulsen1234";
    private $dbname = "orakoglu_db_gulsen";
    public $conn;

    // Yapici metod
    function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    
        // Eger baglanti hatasi varsa, hata mesaji ver
        if ($this->conn->connect_error) {
            die("Baglanti hatasi: " . $this->conn->connect_error);  
        }
    }
    
    // Kullanici ekleme fonksiyonu
    function ekleme($first_Parametre, $second_parametre) {
        $sql = "INSERT INTO kullaniciGirisKontrol (tcKimlikNumarasi, password_hash, olusturulmaTarihi, güncellenmeTarihi, basarisizGiris, hesapKilitleme, sonBasariliGiris)
                VALUES (?, ?, NOW(), NOW(), 0, 1, NOW())";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            echo "Hazirlama hatasi: " . $this->conn->error;
            exit;
        }
        $stmt->bind_param("ss", $first_Parametre, $second_parametre);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
 
    // Kullanici silme fonksiyonu
    function silme($first_Parametre) {
        $sql = "DELETE FROM kullaniciGirisKontrol WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $first_Parametre);
        $stmt->execute();
        $stmt->close();
    }

    // Kullanici güncelleme fonksiyonu
    function güncelleme($first_Parametre, $second_parametre) {
        $sql = "UPDATE kullaniciGirisKontrol SET tcKimlikNumarasi=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $first_Parametre, $second_parametre);
        $stmt->execute();
        $stmt->close();
    }

    // Kullanici giris dogrulama fonksiyonu
    function girisDogrulama($tcNumarasi, $password) {
        $sql2 = "SELECT password_hash FROM kullaniciGirisKontrol WHERE tcKimlikNumarasi = ?";
        if ($stmt = $this->conn->prepare($sql2)) {
            $stmt->bind_param("s", $tcNumarasi); 
            $stmt->execute(); 
            $result = $stmt->get_result();  
            
            if ($result->num_rows === 0) {
                $stmt->close(); 
                return json_encode(["success" => false, "message" => "TC Kimlik Numarasi bulunamadi."]);
            }
            
            $row = $result->fetch_assoc();  
            $hashedPassword = $row['password_hash'];

            if ($password === $hashedPassword) {
                $stmt->close();  
                return json_encode(["success" => true, "message" => "Giris basarili."]);
            } else {
                $stmt->close();  
                return json_encode(["success" => false, "message" => "Sifre hatali."]);
            }
        }
    }
    
    
    public function __destruct() {
        if ($this->conn && $this->conn instanceof mysqli) {  
            $this->conn->close();
          
        } else {
            echo "Baglanti zaten kapali veya gecersiz!";
        }
    }

    public function girisYap($tcNo, $password, $ipAdres) {
        $conn = $this->conn;
        $fonkSonuc;
        if ($stmt = $conn->prepare("CALL KullaniciGirisKontrol(?, ?, ?)")) {
            $stmt->bind_param("sss", $tcNo, $password, $ipAdres);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
            
                if ($result && $row = $result->fetch_assoc()) {
                 
         
                    if (isset($row['sonuc'])) {
                        $sonuc = $row['sonuc'];
                        
                        if ($sonuc == 1) {
                            session_start(); 
                            $_SESSION['kullaniciId'] = $row['kullaniciId'];
                            
                            $stmt->close();

                            return 1;

                        } else {
                            $stmt->close();
                            return 0;
                        }
                    } else {
                        $stmt->close();
                        return 0;
                    }
                } 
            } else {
                $stmt->close();
                return 0;
            }
        } else {
            return 0;
        }
    }
    

    
}    
?>

<?php
class Database {
    private $host = '213.238.183.62';  // Veritabanı host adı
    private $db = 'orakoglu_db_gulsen';            // Veritabanı adı
    private $user = 'orakoglu_gulsen';  // Veritabanı kullanıcı adı
    private $pass = 'Gulsen1234';     // Veritabanı şifresi

    public $conn;  // Veritabanı bağlantısı

    // Veritabanına bağlanma fonksiyonu
    public function connect() {
        // Veritabanına bağlan
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        // Bağlantı kontrolü
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>

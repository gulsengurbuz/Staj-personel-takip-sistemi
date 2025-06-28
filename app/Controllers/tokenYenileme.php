<?php
/* SESSİONU BAŞLAT 
1.KULLANICININ ID İNİ GÖNDER
2.PROSEDÜRE GÖNDER PROSEDÜRDEN SONUÇ AL VE DEĞİŞTİRME İŞLEMİNİ BAŞLAT.
3. DEĞİŞEN TOKENI AL VE SESSİONA KAYDET.
4.TOKEN VA MI KONTTROL ET. VEEĞER VARSA VE GEÇERLİ İSE DASHBOARD SAYFASONA GÖNDER
5.TOKEN DEĞİŞTİĞİNDE ESKİ TOKENI SİL.
6. GİRİŞ YAPTI TAKİBİ BAŞLAT.
-TOKENI AL SESSİONDA SAKLA 
- HER İŞLEMDE VERİ TABANINDAN YENİLE VE YENİ TOKEN ATAMA YAPTIR.
-SESSİON İLE SAYFA YENİLEME, BUTON TIKLAMA, LİNKE TIKLAMA SAYFA DEĞİŞTİRME İŞLERMLERİNİ KONTROL ET. 
*/
/*
require '/home/orakoglu/public_html/gulsen/php/database.php'; // mysql bağlantısını sağlamada kullacağım. 
session_start();

$db = new Database();
$conn = $db->conn; 
*/
include "../../config/config.php";

session_start();

echo "<pre>";

echo "</pre>";

if(isset($_SESSION['kullaniciId'])){
    $session_id = $_SESSION['kullaniciId'];
} else {
    header("Location:../views/login.php");
    die();
}

// Veritabanımda token var mı kontrol edelim
$token_Varmi = "SELECT * FROM token WHERE user_id = $session_id AND token_status = 'aktif' AND token_finish > NOW()";
$sonuc = $conn->query($token_Varmi);

// num_rows sql sorgusu sonucu dönen satır sayısını verir
if ($sonuc->num_rows > 0) {
    echo "Aktif token bulundu!";

    $tokentablosu = $sonuc->fetch_assoc();  
    $token = $tokentablosu['token'];
    $ip_address = $tokentablosu['ip_address'];
    $user_agent = $tokentablosu['user_agent'];

   /* print_r($token);  */
} else {
    echo "Aktif bir token bulunamadı.";
}

// Token kontrol prosedürünü çalıştırıyoruz
$tokenkontrol = "CALL tokenKontrol(?,?,?,?)";
$hazirlama = $conn->prepare($tokenkontrol);
$hazirlama->bind_param("isss", $session_id, $token, $ip_address, $user_agent);
$hazirlama->execute();
$hazirlama->store_result();

$num_rows = $hazirlama->num_rows;
//echo "uzunluk: ".$num_rows;
if($num_rows > 0){
    $hazirlama->bind_result($yenitoken);  // Sorguda dönen alanlarla eşleşme sağlaması gerekiyor
    $hazirlama->fetch();  

    // Yeni token'ı session'a kaydediyoruz
    $_SESSION['token'] = $yenitoken;
} else {
    echo "Aktif bir token bulunamadı veya hata oluştu.";
}

$hazirlama->free_result();  
$hazirlama->close();       

?>

<?php
require_once "../../config/config.php";  // kendi config yolunu yaz

// Dosya yükleme klasörü
$uploadDir = "../../uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// POST ile gelen verileri al
$konu = $_POST["konu"];
$kategori = $_POST["kategori"];
$oncelik = $_POST["oncelik"];
$aciklama = $_POST["aciklama"];
$olusturan = $_POST["olusturan_adi"];

// Durum ve tarihleri otomatik ata
$durum = "Beklemede";
$atanan = null; // henüz atanmadı
$olusturma_tarihi = date("Y-m-d H:i:s");
$son_guncelleme = date("Y-m-d H:i:s");

// Dosya yükleme işlemi
$ek_dosyalar = [];

if (isset($_FILES['ekler'])) {
    for ($i = 0; $i < count($_FILES['ekler']['name']); $i++) {
        if ($_FILES['ekler']['error'][$i] == 0) {
            $tmpName = $_FILES['ekler']['tmp_name'][$i];
            $fileName = uniqid() . "_" . basename($_FILES['ekler']['name'][$i]);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $filePath)) {
                $ek_dosyalar[] = $fileName;
            }
        }
    }
}
$ek_dosyalar_json = json_encode($ek_dosyalar);

// SQL kayıt
$stmt = $conn->prepare("INSERT INTO destek_talepleri (konu, kategori, oncelik, aciklama, ek_dosyalar, durum, olusturan_adi, atanan_adi, olusturma_tarihi, son_guncelleme) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssss", $konu, $kategori, $oncelik, $aciklama, $ek_dosyalar_json, $durum, $olusturan, $atanan, $olusturma_tarihi, $son_guncelleme);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "talep_id" => $stmt->insert_id]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>

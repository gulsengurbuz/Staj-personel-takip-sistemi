<?php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

// Gelen JSON verisini al
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Gerekli alanlar kontrol ediliyor
if (!isset($data['izinIDler']) || !is_array($data['izinIDler']) || empty($data['aciklama'])) {
    http_response_code(400);
    echo json_encode(["hata" => "Geçersiz veri: izin ID'leri veya açıklama eksik."]);
    exit;
}

$izinIDler = $data['izinIDler'];
$aciklama = $data['aciklama'];
$redTarihi = date('Y-m-d');

// Sorguyu hazırla
$sql = "UPDATE izinler SET 
            izin_onay_durumu = 'Reddedildi',
            izin_aciklamasi = ?,
            izin_red_tarihi = ?,
            izin_onay_durum_degistigi_tarihler = NOW()
        WHERE id = ?";

$stmt = $conn->prepare($sql);

// Her ID için güncelleme yap
foreach ($izinIDler as $id) {
    $stmt->bind_param("ssi", $aciklama, $redTarihi, $id);
    $stmt->execute();
}

$stmt->close();
$conn->close();

// Başarılı yanıt gönder
echo json_encode(["mesaj" => "Seçilen izinler başarıyla reddedildi."]);

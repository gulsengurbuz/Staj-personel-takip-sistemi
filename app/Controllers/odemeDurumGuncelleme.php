<?php
// /app/Controllers/odemeDurumGuncelle.php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!isset($data['odemeIDler']) || !is_array($data['odemeIDler']) || !isset($data['durum'])) {
        throw new Exception("Geçersiz veri: odemeIDler veya durum eksik.");
    }

    $odemeIDler = $data['odemeIDler'];
    $durum = $data['durum'];
    $tarih = date("Y-m-d");

    if ($durum !== "ödendi" && $durum !== "reddedildi") {
        throw new Exception("Geçersiz durum: $durum");
    }

    // Sorgu: güncellenecek alanlar
    if ($durum === "ödendi") {
        $sql = "UPDATE maas_odeme 
                SET odeme_durumu = 'ödendi', odeme_onay_tarihi = ?,odemeGuncellemeTarihi=NOW()
                WHERE odeme_id = ?";
    } else {
        $sql = "UPDATE maas_odeme 
                SET odeme_durumu = 'reddedildi', odeme_red_tarihi = ? ,odemeGuncellemeTarihi=NOW()
                WHERE odeme_id = ?";
    }

    $stmt = $conn->prepare($sql);

    foreach ($odemeIDler as $id) {
        $stmt->bind_param("si", $tarih, $id);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo json_encode(["success" => true, "mesaj" => "Seçilen ödemeler '$durum' olarak güncellendi."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "hata" => $e->getMessage()]);
}

<?php
// /app/Controllers/personelTalepDurumGuncelle.php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['talepIDler']) || !is_array($input['talepIDler']) || !isset($input['durum'])) {
        throw new Exception("Geçersiz veya eksik veri gönderildi.");
    }

    $talepIDler = $input['talepIDler'];
    $durum = $conn->real_escape_string($input['durum']);

    $sql = "UPDATE personelTalepleri 
            SET talep_durumu = ?,personelGuncellemeTarihi=NOW()
            WHERE talep_id = ?";

    $stmt = $conn->prepare($sql);

    foreach ($talepIDler as $talep_id) {
        $talep_id = intval($talep_id);
        $stmt->bind_param("si", $durum, $talep_id);
        $stmt->execute();
    }

    echo json_encode(["success" => true, "mesaj" => "Talepler başarıyla güncellendi."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "mesaj" => $e->getMessage()]);
}

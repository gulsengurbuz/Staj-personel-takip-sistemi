<?php
// /app/Controllers/digerTalepDurumGuncelle.php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['talepIDler']) || !is_array($input['talepIDler']) || !isset($input['durum'])) {
        throw new Exception("Geçersiz veya eksik veri gönderildi.");
    }

    $talepIDler = $input['talepIDler'];
    $durum = $conn->real_escape_string($input['durum']);
    $tarih = date("Y-m-d H:i:s");

    $sql = "UPDATE diger_talepler 
            SET talep_durumu = ?, updated_at = ?,digerTalepGuncellemeTarihi=NOW()
            WHERE talep_id = ?";

    $stmt = $conn->prepare($sql);

    foreach ($talepIDler as $talep_id) {
        $talep_id = intval($talep_id);
        $stmt->bind_param("ssi", $durum, $tarih, $talep_id);
        $stmt->execute();
    }

    echo json_encode(["success" => true, "mesaj" => "Diğer talepler başarıyla güncellendi."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "mesaj" => $e->getMessage()]);
}

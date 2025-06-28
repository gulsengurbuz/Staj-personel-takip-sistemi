<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['error' => 'Geçersiz ID']);
    http_response_code(400);
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT 
    id,
    personel_id,
    izin_turu_id,
    baslangic_tarihi,
    bitis_tarihi,
    toplam_gun,
    izin_onay_durumu,
    izin_tarihleri,
    izin_aciklamasi,
    izin_talep_tarihi,
    izin_onay_tarihi,
    izin_red_tarihi,
    izin_onay_durum_degistigi_tarihler
FROM izinler
WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Kayıt bulunamadı']);
    http_response_code(404);
}

$stmt->close();
$conn->close();

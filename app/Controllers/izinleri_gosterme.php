<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/config.php';

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
ORDER BY id DESC";

$result = $conn->query($sql);
$izinler = [];

while ($row = $result->fetch_assoc()) {
    $izinler[] = $row;
}

echo json_encode($izinler);
$conn->close();
?>

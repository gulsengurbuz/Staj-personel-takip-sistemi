<?php
// Hataları göster
ini_set('display_errors', 1);
error_reporting(E_ALL);

// JSON çıktısı gönderilecek
header('Content-Type: application/json');

// Veritabanı bağlantısını dahil et
require_once __DIR__ . "/../../config/config.php";

// $conn artık config.php'de tanımlı

// SQL sorgusu
$sql = "
    SELECT
        SUM(CASE WHEN izin_onay_durumu = 'Onaylandı' THEN 1 ELSE 0 END) AS onaylandi,
        SUM(CASE WHEN izin_onay_durumu = 'Reddedildi' THEN 1 ELSE 0 END) AS reddedildi,
        SUM(CASE WHEN izin_onay_durumu = 'Bekliyor' THEN 1 ELSE 0 END) AS bekleyen
    FROM izinler;
";

$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode([
        'onaylandi' => 0,
        'reddedildi' => 0,
        'bekleyen' => 0
    ]);
}

$conn->close();
?>

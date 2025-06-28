<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../config/config.php"; // DB bağlantı dosyan

$response = [];

// 1. Toplam personel sayısı
$personelSorgu = $conn->query("SELECT COUNT(*) AS toplam_personel FROM PersonelTable");
if ($personelSorgu && $row = $personelSorgu->fetch_assoc()) {
    $response['toplam_personel'] = (int)$row['toplam_personel'];
}


// 2. Bu ay yapılan ödemeler
$odemeSorgu = $conn->query("SELECT SUM(odeme_tutari) AS toplam_odeme FROM maas_odeme WHERE MONTH(odeme_tarihi) = MONTH(CURRENT_DATE()) AND YEAR(odeme_tarihi) = YEAR(CURRENT_DATE()) AND odeme_durumu = 'Ödendi'");
if ($odemeSorgu && $row = $odemeSorgu->fetch_assoc()) {
    $response['bu_ay_odenen'] = (float)$row['toplam_odeme'];
}

// 3. Bekleyen ödemeler
$bekleyenSorgu = $conn->query("SELECT SUM(odeme_tutari) AS toplam_bekleyen FROM maas_odeme WHERE odeme_durumu = 'Beklemede'");
if ($bekleyenSorgu && $row = $bekleyenSorgu->fetch_assoc()) {
    $response['bekleyen_odeme'] = (float)$row['toplam_bekleyen'];
}

$conn->close();

// JSON çıktısı
echo json_encode($response, JSON_UNESCAPED_UNICODE);

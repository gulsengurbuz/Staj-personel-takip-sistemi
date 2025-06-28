<?php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    
    $izin_sql = "SELECT COUNT(*) AS sayi FROM izinler WHERE izin_onay_durumu = 'Bekliyor'";
    $izin_result = $conn->query($izin_sql);
    $izin_sayi = 0;

    if ($izin_result) {
        $izin_row = $izin_result->fetch_assoc();
        $izin_sayi = $izin_row['sayi'];
    }

    
    $odeme_sql = "SELECT COUNT(*) AS sayi FROM maas_odeme WHERE odeme_durumu = 'Beklemede'";
    $odeme_result = $conn->query($odeme_sql);
    $odeme_sayi = 0;

    if ($odeme_result) {
        $odeme_row = $odeme_result->fetch_assoc();
        $odeme_sayi = $odeme_row['sayi'];
    }

  
    echo json_encode([
        'status' => 'success',
        'izin_sayi' => $izin_sayi,
        'odeme_sayi' => $odeme_sayi
    ]);
} catch (Exception $e) {
    
    echo json_encode([
        'status' => 'error',
        'message' => 'Hata oluştu: ' . $e->getMessage()
    ]);
}
?>

<?php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    
    $personel_sql = "SELECT COUNT(*) AS sayi FROM personelTalepleri WHERE talep_durumu = 'Bekliyor'";
    $personel_result = $conn->query($personel_sql);
    $personel_sayi = 0;

    if ($personel_result) {
        $personel_row = $personel_result->fetch_assoc();
        $personel_sayi = $personel_row['sayi'];
    }

    echo json_encode([
        'status' => 'success',
        'personel_sayi' => $personel_sayi
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Hata oluştu: ' . $e->getMessage()
    ]);
}
?>

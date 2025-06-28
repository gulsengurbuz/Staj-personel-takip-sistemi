<?php
ob_start();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $personel_id   = $_POST['personel_id'] ?? null;
    $ad_soyad      = $_POST['ad_soyad'] ?? '';
    $telefon_no    = $_POST['telefon_no'] ?? '';
    $departman_id  = $_POST['departman_id'] ?? '';
    $pozisyon_id   = $_POST['pozisyon_id'] ?? '';
    $durumu        = $_POST['durumu'] ?? '';
    $fotograf_blob = null;

    if (isset($_FILES['fotograf']) && $_FILES['fotograf']['error'] === UPLOAD_ERR_OK) {
        $fotograf_blob = file_get_contents($_FILES['fotograf']['tmp_name']);
    }
   
    $stmt = $conn->prepare("CALL personelGuncelle(?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ibsssss", 
            $personel_id,      
            $fotograf_blob,      
            $ad_soyad,           
            $telefon_no,        
            $departman_id,      
            $pozisyon_id,        
            $durumu              
        );

        if (!is_null($fotograf_blob)) {
            $stmt->send_long_data(1, $fotograf_blob); 
        }

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Personel başarıyla güncellendi."
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Sorgu çalıştırılamadı: " . $stmt->error
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Sorgu hazırlanamadı: " . $conn->error
        ]);
    }

    $conn->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Geçersiz istek yöntemi."
    ]);
}

file_put_contents("debug_log.txt", ob_get_contents());
ob_end_flush();
?>

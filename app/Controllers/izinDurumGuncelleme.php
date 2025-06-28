<?php
require_once __DIR__ . "/../../config/config.php";
header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['personel_id'], $input['durum'])) {
     
        throw new Exception("Gerekli veriler eksik.".json_encode($input));
    }

    $personelId = intval($input['personel_id']);
    $durum = $conn->real_escape_string($input['durum']);
    $tarih = date("Y-m-d H:i:s");

    // Kontrol: Bu personelin bekleyen bir talebi var mı?
    $sqlSelect = "SELECT COUNT(*) as sayi FROM izinler 
                  WHERE personel_id = ? AND izin_onay_durumu = 'Bekliyor'";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $personelId);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result()->fetch_assoc();

    if ($result['sayi'] == 0) {
        throw new Exception("Bekleyen izin kaydı bulunamadı.");
    }

    // Duruma göre update işlemi
    if ($durum === "Onaylandı") {
        $sqlUpdate = "UPDATE izinler 
                      SET izin_onay_durumu = 'Onaylandı', 
                          izin_onay_tarihi = ?, 
                          izin_onay_durum_degistigi_tarihler = ?,
                          izinGuncellemeTarihi=NOW()
                      WHERE personel_id = ? AND izin_onay_durumu = 'Bekliyor'
                      ORDER BY izin_talep_tarihi DESC
                      LIMIT 1";
    } elseif ($durum === "Reddedildi") {
        $sqlUpdate = "UPDATE izinler 
                      SET izin_onay_durumu = 'Reddedildi', 
                          izin_red_tarihi = ?, 
                          izin_onay_durum_degistigi_tarihler = ?,
                          izinGuncellemeTarihi=NOW()
                      WHERE personel_id = ? AND izin_onay_durumu = 'Bekliyor'
                      ORDER BY izin_talep_tarihi DESC
                      LIMIT 1";
    } else {
        throw new Exception("Geçersiz durum değeri.");
    }

    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssi", $tarih, $tarih, $personelId);
    $stmtUpdate->execute();

    echo json_encode(["success" => true, "updated_personel_id" => $personelId]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

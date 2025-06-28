<?php
require_once __DIR__ . "/../../config/config.php";
header("Content-Type: application/json");

// Hatalari göster
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // SQL sorgusu - JOIN ile personel ve izin_turleri tablosu eklendi
    $sql = "SELECT 
                i.id,
                i.personel_id,
                p.ad_soyad,
                pz.pozisyon_adi,
                i.izin_turu_id,
                t.izin_turu_adi,
                i.baslangic_tarihi,
                i.bitis_tarihi,
                i.toplam_gun,
                i.izin_onay_durumu,
                i.izin_tarihleri,
                i.izin_aciklamasi,
                i.izin_talep_tarihi,
                i.izin_onay_tarihi,
                i.izin_red_tarihi,
                i.izin_onay_durum_degistigi_tarihler
            FROM izinler i
            INNER JOIN PersonelTable p ON i.personel_id = p.personel_id
            INNER JOIN pozisyonlar pz ON i.personel_id = pz.personel_id
            INNER JOIN izin_turleri t ON i.izin_turu_id = t.izin_turu_id
            WHERE i.izin_onay_durumu = 'Bekliyor'
            ORDER BY i.izin_talep_tarihi DESC";

    $result = $conn->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

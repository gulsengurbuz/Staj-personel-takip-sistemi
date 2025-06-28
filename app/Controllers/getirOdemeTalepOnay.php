<?php
// /app/Controllers/getOdemeTalepleri.php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    $sql = "SELECT m.odeme_id, m.personel_id, p.ad_soyad, m.odeme_tutari, m.odeme_tarihi,
                   m.odeme_turu_id, o.odeme_turu AS odeme_turu_adi, m.odeme_durumu,
                   m.odeme_talep_tarihi, m.odeme_aciklamasi
            FROM maas_odeme m
            LEFT JOIN PersonelTable p ON m.personel_id = p.personel_id
            LEFT JOIN odeme_turu o ON m.odeme_turu_id = o.id
            WHERE m.odeme_durumu = 'Beklemede'
            ORDER BY m.odeme_tarihi DESC";

    $result = $conn->query($sql);
    $data = [];

    if (!$result) {
        throw new Exception("SQL hatası: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["hata" => "Veri alınamadı: " . $e->getMessage()]);
}
<?php
// /app/Controllers/getirPersonelTalepleri.php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    $sql = "SELECT pt.talep_id, pt.personel_id, p.ad_soyad, pt.talep_tipi,
                   pt.talep_tarihi, pt.talep_durumu, pt.aciklama, pt.created_at
            FROM personelTalepleri pt
            LEFT JOIN PersonelTable p ON pt.personel_id = p.personel_id
            WHERE pt.talep_durumu = 'Bekliyor'
            ORDER BY pt.created_at DESC";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Sorgu hatası: " . $conn->error);
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "mesaj" => $e->getMessage()]);
}

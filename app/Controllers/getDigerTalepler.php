<?php
// /app/Controllers/getirDigerTalepler.php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    $sql = "SELECT dt.talep_id, dt.personel_id, p.ad_soyad, dt.talep_turu,
                   dt.talep_tarihi, dt.aciklama, dt.belge_yolu, dt.talep_durumu, dt.created_at
            FROM diger_talepler dt
            LEFT JOIN PersonelTable p ON dt.personel_id = p.personel_id
            WHERE dt.talep_durumu = 'Beklemede'
            ORDER BY dt.created_at DESC";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("SQL hatası: " . $conn->error);
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

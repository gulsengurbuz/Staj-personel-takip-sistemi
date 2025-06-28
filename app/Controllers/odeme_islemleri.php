<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../config/config.php"; // Bağlantı dosyan

$response = [
    'maas' => 0,
    'prim' => 0,
    'avans' => 0,
    'mesai' => 0,
    'tazminat' => 0
];

$sql = "SELECT odeme_turu_id, COUNT(*) AS adet
        FROM maas_odeme
        GROUP BY odeme_turu_id";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    switch ($row['odeme_turu_id']) {
        case 1: $response['maas'] = (int)$row['adet']; break;
        case 2: $response['prim'] = (int)$row['adet']; break;
        case 3: $response['avans'] = (int)$row['adet']; break;
        case 4: $response['mesai'] = (int)$row['adet']; break;
        case 5: $response['tazminat'] = (int)$row['adet']; break;
    }
}

$conn->close();
echo json_encode($response, JSON_UNESCAPED_UNICODE);

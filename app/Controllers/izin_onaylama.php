<?php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

// Giriş kontrolü
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (!isset($data['izinIDler']) || !is_array($data['izinIDler'])) {
    http_response_code(400);
    echo json_encode(["hata" => "Geçersiz veri"]);
    exit;
}

$izinIDler = $data['izinIDler'];
$onayTarihi = date('Y-m-d');

$sql = "UPDATE izinler SET izin_onay_durumu = 'Onaylandı', izin_onay_tarihi = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

foreach ($izinIDler as $id) {
    $stmt->bind_param("si", $onayTarihi, $id);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(["mesaj" => "İzinler başarıyla onaylandı."]);

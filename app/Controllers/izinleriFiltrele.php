<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/config.php';

$personel = $_POST['personel'] ?? '';
$izinTuru = $_POST['izinTuru'] ?? '';
$baslangic = $_POST['baslangic'] ?? '';
$bitis = $_POST['bitis'] ?? '';

$sql = "SELECT * FROM izinler WHERE 1=1";

$params = [];
if (!empty($personel)) {
    $sql .= " AND personel_id = ?";
    $params[] = $personel;
}
if (!empty($izinTuru)) {
    $sql .= " AND izin_turu_id = ?";
    $params[] = $izinTuru;
}
if (!empty($baslangic) && !empty($bitis)) {
    $sql .= " AND baslangic_tarihi >= ? AND bitis_tarihi <= ?";
    $params[] = $baslangic;
    $params[] = $bitis;
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $types = str_repeat("i", count($params));
    if ($baslangic && $bitis) {
        $types = str_replace("ii", "ss", $types); 
    }
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$izinler = [];
while ($row = $result->fetch_assoc()) {
    $izinler[] = $row;
}

echo json_encode($izinler, JSON_UNESCAPED_UNICODE);
$conn->close();
?>

<?php
require_once '../../config/config.php';
header("Content-Type: application/json");
$sql = "SELECT * FROM destek_talepleri ORDER BY olusturma_tarihi DESC";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        "success" => false,
        "message" => "SQL Hatası: " . $conn->error
    ]);
    exit;
}

$talepler = [];
while ($row = $result->fetch_assoc()) {
    $row['durum_rengi'] = match($row['durum']) {
        "Beklemede" => "warning",
        "İşlemde" => "info",
        "Çözüldü" => "success",
        "Kapatıldı" => "secondary",
        default => "light"
    };
    $talepler[] = $row;
}

echo json_encode($talepler);

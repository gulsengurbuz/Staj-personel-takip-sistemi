<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../config/config.php"; // Veritabanı bağlantısı

$veriler = [];

$result = $conn->query("CALL get_son_odeme_hareketleri()");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $veriler[] = $row;
    }
    $result->free();
    // Çoklu sonuç kümesi varsa temizle
    while ($conn->more_results() && $conn->next_result()) {
        $conn->use_result();
    }
}

$conn->close();
echo json_encode($veriler, JSON_UNESCAPED_UNICODE);

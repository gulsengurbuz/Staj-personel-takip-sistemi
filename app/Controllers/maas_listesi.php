<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../config/config.php"; // Veritabanı bağlantı dosyan

$liste = [];

// Prosedürü çağır
$sql = "CALL maas_Listesi_Getir()";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $liste[] = $row;
    }
    // Eğer prosedür başka result set döndürüyorsa onları temizle
    while ($conn->more_results() && $conn->next_result()) {
        $conn->use_result();
    }
}

$conn->close();
echo json_encode($liste, JSON_UNESCAPED_UNICODE);

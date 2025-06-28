<?php
require_once "../../config/config.php";

$talep_id = intval($_GET["talep_id"]);

$stmt = $conn->prepare("SELECT * FROM destek_yanitlar WHERE talep_id = ? ORDER BY tarih ASC");
$stmt->bind_param("i", $talep_id);
$stmt->execute();
$result = $stmt->get_result();

$yanitlar = [];

while ($row = $result->fetch_assoc()) {
    $row["ekler"] = json_decode($row["ekler"], true);
    $yanitlar[] = $row;
}

echo json_encode($yanitlar);
?>

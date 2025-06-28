<?php
require_once "../../config/config.php";

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM destek_talepleri WHERE talep_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Kayıt bulunamadı"]);
    exit;
}

$row = $result->fetch_assoc();

// Dosya varsa JSON decode yap
$row['ek_dosyalar'] = $row['ek_dosyalar'] ? json_decode($row['ek_dosyalar'], true) : [];

echo json_encode(["status" => "success", "data" => $row]);
$conn->close();
?>

<?php
require_once "../../config/config.php";

$data = json_decode(file_get_contents("php://input"), true);

$konu = $data["konu"];
$kategori = $data["kategori"];
$oncelik = $data["oncelik"];
$aciklama = $data["aciklama"];
$ekler = json_encode($data["ekler"]);
$olusturan = $data["olusturan"];

$stmt = $conn->prepare("INSERT INTO destek_talepleri (konu, kategori, oncelik, aciklama, ekler, olusturan) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $konu, $kategori, $oncelik, $aciklama, $ekler, $olusturan);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "talep_id" => $stmt->insert_id]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}
?>

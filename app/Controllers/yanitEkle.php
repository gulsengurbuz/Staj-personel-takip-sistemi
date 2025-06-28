<?php
require_once "../../config/config.php";

$data = json_decode(file_get_contents("php://input"), true);

$talep_id = intval($data["talep_id"]);
$yanitlayan = $data["yanitlayan"];
$rol = $data["rol"];
$mesaj = $data["mesaj"];
$ekler = json_encode($data["ekler"]);

$stmt = $conn->prepare("INSERT INTO destek_yanitlar (talep_id, yanitlayan, rol, mesaj, ekler) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $talep_id, $yanitlayan, $rol, $mesaj, $ekler);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}
?>

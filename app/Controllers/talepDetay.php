<?php
require_once "../../config/config.php";

$talep_id = intval($_GET["talep_id"]);

$stmt = $conn->prepare("SELECT * FROM destek_talepleri WHERE talep_id = ?");
$stmt->bind_param("i", $talep_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $data["ekler"] = json_decode($data["ekler"], true);
    echo json_encode($data);
} else {
    echo json_encode(["status" => "error", "message" => "Talep bulunamadı"]);
}
?>

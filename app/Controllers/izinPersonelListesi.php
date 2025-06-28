<?php
include "../../config/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn->set_charset("utf8mb4");

$sql = "SELECT personel_id, ad_soyad FROM PersonelTable";

$result = $conn->query($sql);


if (!$result) {
    die("Sorgu hatası: " . $conn->error); // 💥 SİHİRLİ SATIR
}

$personeller = [];

while ($row = $result->fetch_assoc()) {
    $personeller[] = [
        "personel_id" => $row["personel_id"],
        "ad_soyad" => mb_convert_encoding($row["ad_soyad"], "UTF-8", "auto")
    ];
}

header("Content-Type: application/json");
echo json_encode($personeller, JSON_UNESCAPED_UNICODE);
$conn->close();
?>

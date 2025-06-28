<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../config/config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prosedürü çağır
    $result = $conn->query("CALL personeliSilme($id)");

    if ($result) {
        echo json_encode(["basarili" => true]);
    } else {
        echo json_encode(["hata" => "Prosedür çalıştırılamadı: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["hata" => "ID parametresi eksik."]);
}
?>

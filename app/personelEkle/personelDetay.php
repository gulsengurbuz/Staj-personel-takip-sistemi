<?php
include '../php/database.php';

if (isset($_POST['id'])) {
    $personel_id = $_POST['id'];

    $baglanti = new Database();
    $baglanti->connect();

    $sql = "CALL PersonelDetayGösterme(?)";
    $stmt = $baglanti->conn->prepare($sql);
    $stmt->bind_param("i", $personel_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $personel = $result->fetch_assoc();
        echo json_encode(["status" => "success", "data" => $personel]);
    } else {
        echo json_encode(["status" => "error", "message" => "Personel bulunamadı."]);
    }

    $stmt->close();
    $baglanti->close();
} else {
    echo json_encode(["status" => "error", "message" => "Geçersiz istek."]);
}
?>

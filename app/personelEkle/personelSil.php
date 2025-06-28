<?php
include '../php/database.php';

if (isset($_POST['id'])) {
    $personel_id = $_POST['id'];

    $baglanti = new Database();
    $baglanti->connect();

    // Personeli silme sorgusu
    $sql = "DELETE FROM personel WHERE personel_id = ?";

    $stmt = $baglanti->conn->prepare($sql);
    $stmt->bind_param("i", $personel_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Personel başarıyla silindi."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Silme işlemi başarısız."]);
    }

    $stmt->close();
    $baglanti->close();
} else {
    echo json_encode(["status" => "error", "message" => "Geçersiz istek."]);
}
?>

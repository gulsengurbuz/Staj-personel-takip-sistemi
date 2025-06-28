<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');


require '../../config/database.php';



$tcNo = isset($_POST['tcNo']) ? $_POST['tcNo']: '';
$password = isset($_POST['password']) ? $_POST['password']: '';

if (empty($tcNo) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Eksik veri gönderildi."]);
    exit;
}

$ipAdres = $_SERVER['REMOTE_ADDR']; 

$hashedPassword = hash('sha256',$password);

$e = new database();
$result = $e->girisYap($tcNo, $password, $ipAdres);
 /*json_encode([
    "result" => $result
]);*/


if ($result == 1) {
    echo json_encode(["success" => true, "message" => "Giris basarili."]);
} else {
    echo json_encode(["success" => false, "message" => "Giris basarisiz."]);
}
?>

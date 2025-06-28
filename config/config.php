<?php

// Hata raporlamayı açıyoruz
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Veritabanı bilgilerini tanımlıyoruz
$servername = "213.238.183.60";
$username = "orakoglu_gulsen";
$password = "Gulsen1234";
$dbname = "orakoglu_db_gulsen";

// Veritabanı bağlantısını kuruyoruz
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası varsa, hata mesajı veriyoruz
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}



?>

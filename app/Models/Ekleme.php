<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

include "../../config/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["fotograf"])) {
      /*  $foto = addslashes(file_get_contents($_FILES["fotograf"]["tmp_name"]));
        $hexFotoğraf = bin2hex($foto); */
        $foto = file_get_contents($_FILES["fotograf"]["tmp_name"]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Fotoğraf yüklenemedi."
        ]);
        exit;
    }

    // Form verilerini al
    $adsoyad = $_POST["adsoyad"];
    $email = $_POST["email"];
    $dogum_tarihi = $_POST["dogum_tarihi"];
    $cinsiyet = $_POST["cinsiyet"];
    $telefon_turu = $_POST["telefon_turu"];
    $telefon_no = $_POST["telefon_no"];
    $durumu = $_POST["durumu"];
    $departman_id = $_POST["departman_id"];
    $departman_adi = $_POST["departman_adi"];
    $departman_kodu = $_POST["departman_kodu"];
    $is_baslama_tarihi = $_POST["is_baslama_tarihi"];
    $is_durumu = $_POST["is_durumu"];
    $is_tanimi = $_POST["is_tanimi"];
    $departman_aciklama = $_POST["departman_aciklama"];
    $odeme_tutari = $_POST["odeme_tutari"];
    $odeme_turu_id = $_POST["odeme_turu_id"];
    $aktif_mi = $_POST["aktif_mi"];
    $pozisyon_adi = $_POST["pozisyon_adi"];
    $calisan_sayisi = $_POST["calisan_sayisi"];
    $tecrube_yili = $_POST["tecrube_yili"];
    $egitim_seviyesi = $_POST["egitim_seviyesi"];
    $pozisyon_id = $_POST["pozisyon_id"];
    $pozisyon_tipi = $_POST["pozisyon_tipi"];
    $yetki_durumu = $_POST["yetki_durumu"];
    $kan_grubu = $_POST["kan_grubu"];

    if ($stmt = $conn->prepare("CALL personelEkle(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @OUTsonuc)")) {

        $stmt->bind_param("bssssssssssssssissssssssss",
            $foto, $adsoyad, $email, $dogum_tarihi, $cinsiyet, $telefon_turu, $telefon_no,
            $durumu, $departman_id, $departman_adi, $departman_kodu, $is_baslama_tarihi, $is_durumu, $is_tanimi,
            $departman_aciklama, $odeme_tutari, $odeme_turu_id, $aktif_mi, $pozisyon_adi, $calisan_sayisi,
            $tecrube_yili, $egitim_seviyesi, $pozisyon_id, $pozisyon_tipi, $yetki_durumu, $kan_grubu
        );

        $stmt->send_long_data(0, $foto);

        if ($stmt->execute()) {
            $sonucSorgu = $conn->query("SELECT @OUTsonuc as sonuc");
            if ($sonucSorgu) {
                $sonuc = $sonucSorgu->fetch_assoc()["sonuc"];
                if ($sonuc == 1) {
                    echo json_encode([
                        "status" => "success",
                        "message" => "Personel başarıyla eklendi."
                    ]);
                } else {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Personel eklenemedi."
                    ]);
                }
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Sonuç alınamadı."
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Hata oluştu: " . $stmt->error
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Sorgu hazırlanamadı: " . $conn->error
        ]);
    }
}
$conn->close();
?>

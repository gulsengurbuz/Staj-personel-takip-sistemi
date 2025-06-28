<?php
include "../../config/config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $personel_id = $_POST["personel_id"];
    $izin_turu_id = $_POST["izin_turu"];
    $baslangic_tarihi = $_POST["baslangic_tarihi"];
    $bitis_tarihi = $_POST["bitis_tarihi"];
    $izin_aciklamasi = $_POST["izin_sebebi"];
    $izin_onay_durumu = "Bekliyor";
    $izin_talep_tarihi = date("Y-m-d H:i:s");
    $izin_onay_tarihi = null;
    $izin_red_tarihi = null;
    $izin_onay_durum_degistigi_tarihler = null;
    $izin_tarihleri = $baslangic_tarihi . " - " . $bitis_tarihi;

    // Toplam gün hesabı
    $start = new DateTime($baslangic_tarihi);
    $end = new DateTime($bitis_tarihi);
    $totalDays = $start->diff($end)->days + 1;

    $sql = "INSERT INTO izinler (
                personel_id,
                izin_turu_id,
                baslangic_tarihi,
                bitis_tarihi,
                toplam_gun,
                izin_onay_durumu,
                izin_tarihleri,
                izin_aciklamasi,
                izin_talep_tarihi,
                izin_onay_tarihi,
                izin_red_tarihi,
                izin_onay_durum_degistigi_tarihler
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssisssssss",
        $personel_id,
        $izin_turu_id,
        $baslangic_tarihi,
        $bitis_tarihi,
        $totalDays,
        $izin_onay_durumu,
        $izin_tarihleri,
        $izin_aciklamasi,
        $izin_talep_tarihi,
        $izin_onay_tarihi,
        $izin_red_tarihi,
        $izin_onay_durum_degistigi_tarihler
    );

    if ($stmt->execute()) {
        echo "İzin talebi başarıyla kaydedildi.";
    } else {
        echo "Veritabanına eklenemedi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>

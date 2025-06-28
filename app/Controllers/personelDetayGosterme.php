<?php
include "../../config/config.php";

if (isset($_POST['personel_id'])) {
    $personel_id = intval($_POST['personel_id']);

    $stmt = $conn->prepare("CALL personel_detay_getir(?)");
    $stmt->bind_param("i", $personel_id);
    $stmt->execute();

    // 1. Personel bilgisi
    $result = $stmt->get_result();
    $personel = $result->fetch_assoc();
    echo "<h5>" . htmlspecialchars($personel['ad_Soyad']) . "</h5>";
    echo "<p><strong>Doğum Tarihi:</strong> " . htmlspecialchars($personel['dogum_Tarihi']) . "</p>";
    echo "<p><strong>Cinsiyet:</strong> " . htmlspecialchars($personel['cinsiyet']) . "</p>";
    echo "<p><strong>Kan Grubu:</strong> " . htmlspecialchars($personel['kan_Grubu']) . "</p>";
    echo "<p><strong>Durumu:</strong> " . htmlspecialchars($personel['durumu']) . "</p>";
    echo "<p><strong>Oluşturulma Tarihi:</strong> " . htmlspecialchars($personel['olusturulma_tarihi']) . "</p>";
    echo "<p><strong>E-Posta:</strong> " . htmlspecialchars($personel['eposta_adresi']) . "</p>";
    echo "<p><strong>Departman ID:</strong> " . htmlspecialchars($personel['departman_id']) . "</p>";
    echo "<p><strong>Pozisyon ID:</strong> " . htmlspecialchars($personel['pozisyon_id']) . "</p>";
    if (!empty($personel['fotograf'])) {
        $imgData = base64_encode($personel['fotograf']);
        echo "<p><strong>Fotoğraf:</strong><br><img src='data:image/jpeg;base64,{$imgData}' width='150' /></p>";
    }
    echo "<hr>";

    // 2. Telefon bilgileri
    if ($stmt->more_results() && $stmt->next_result()) {
        $result = $stmt->get_result();
        echo "<h6>Telefon Bilgileri:</h6><ul>";
        while ($tel = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($tel['telefon_turu']) . ": " . htmlspecialchars($tel['telefon_no']) . "</li>";
        }
        echo "</ul><hr>";
    }

    // 3. Pozisyon bilgileri
    if ($stmt->more_results() && $stmt->next_result()) {
        $result = $stmt->get_result();
        $poz = $result->fetch_assoc();
        echo "<h6>Pozisyon Bilgileri:</h6>";
        echo "<p><strong>Pozisyon:</strong> " . htmlspecialchars($poz['pozisyon_adi']) . "</p>";
        echo "<p><strong>Açıklama:</strong> " . htmlspecialchars($poz['aciklama']) . "</p>";
        echo "<p><strong>İş Tanımı:</strong> " . htmlspecialchars($poz['is_tanimi']) . "</p>";
        echo "<p><strong>Tecrübe Yılı:</strong> " . htmlspecialchars($poz['tecrübe_yili']) . "</p>";
        echo "<p><strong>Eğitim Seviyesi:</strong> " . htmlspecialchars($poz['egitim_seviyesi']) . "</p>";
        echo "<p><strong>Pozisyon Tipi:</strong> " . htmlspecialchars($poz['pozisyon_tipi']) . "</p>";
        echo "<p><strong>Yetki Durumu:</strong> " . htmlspecialchars($poz['yetki_durumu']) . "</p>";
        echo "<p><strong>Oluşturulma Tarihi:</strong> " . htmlspecialchars($poz['olusturulma_tarihi']) . "</p>";
        echo "<p><strong>Son Güncelleme:</strong> " . htmlspecialchars($poz['son_guncellenme_tarihi']) . "</p>";
        echo "<hr>";
    }

    // 4. Departman bilgileri
    if ($stmt->more_results() && $stmt->next_result()) {
        $result = $stmt->get_result();
        $dep = $result->fetch_assoc();
        echo "<h6>Departman Bilgileri:</h6>";
        echo "<p><strong>Departman:</strong> " . htmlspecialchars($dep['departman_Adi']) . "</p>";
        echo "<p><strong>Kodu:</strong> " . htmlspecialchars($dep['departman_Kodu']) . "</p>";
        echo "<p><strong>Başlama Tarihi:</strong> " . htmlspecialchars($dep['is_Baslama_Tarihi']) . "</p>";
        echo "<p><strong>Durumu:</strong> " . htmlspecialchars($dep['is_Durumu']) . "</p>";
        echo "<p><strong>Yöneticisi:</strong> " . htmlspecialchars($dep['departman_yöneticisi']) . "</p>";
        echo "<p><strong>Çalışan Sayısı:</strong> " . htmlspecialchars($dep['calisan_Sayisi']) . "</p>";
        echo "<p><strong>Açıklama:</strong> " . htmlspecialchars($dep['aciklama']) . "</p>";
        echo "<p><strong>Oluşturulma Tarihi:</strong> " . htmlspecialchars($dep['olusturulma_tarihi']) . "</p>";
        echo "<p><strong>Son Güncelleme:</strong> " . htmlspecialchars($dep['son_guncellenme_tarihi']) . "</p>";
        echo "<hr>";
    }

    // 5. İzin bilgileri
    if ($stmt->more_results() && $stmt->next_result()) {
        $result = $stmt->get_result();
        echo "<h6>İzin Bilgileri:</h6><ul>";
        while ($izin = $result->fetch_assoc()) {
            echo "<li><strong>ID:</strong> " . htmlspecialchars($izin['izin_id']) . " | " .
                "<strong>Tür:</strong> " . htmlspecialchars($izin['izin_turu_id']) . " | " .
                "<strong>Başlangıç:</strong> " . htmlspecialchars($izin['baslangic_tarihi']) . " - " .
                "<strong>Bitiş:</strong> " . htmlspecialchars($izin['bitis_tarihi']) . " | " .
                "<strong>Toplam:</strong> " . htmlspecialchars($izin['toplam_gun']) . " gün | " .
                "<strong>Durum:</strong> " . htmlspecialchars($izin['izin_onay_durumu']) . "<br>" .
                "<strong>Açıklama:</strong> " . htmlspecialchars($izin['izin_aciklamasi']) . "<br>" .
                "<strong>Talep:</strong> " . htmlspecialchars($izin['izin_talep_tarihi']) . " | " .
                "<strong>Onay:</strong> " . htmlspecialchars($izin['izin_onay_tarihi']) . " | " .
                "<strong>Red:</strong> " . htmlspecialchars($izin['izin_red_tarihi']) . " | " .
                "<strong>Durum Geçmişi:</strong> " . htmlspecialchars($izin['izin_onay_durum_degistigi_tarihler']) .
                "</li><br>";
        }
        echo "</ul><hr>";
    }

    // 6. Ödeme bilgileri
    if ($stmt->more_results() && $stmt->next_result()) {
        $result = $stmt->get_result();
        echo "<h6>Ödeme Bilgileri:</h6><ul>";
        while ($odeme = $result->fetch_assoc()) {
            echo "<li><strong>ID:</strong> " . htmlspecialchars($odeme['odeme_id']) .
                " | <strong>Tarih:</strong> " . htmlspecialchars($odeme['odeme_tarihi']) .
                " | <strong>Tutar:</strong> " . htmlspecialchars($odeme['odeme_tutari']) . " TL" .
                " | <strong>Durum:</strong> " . htmlspecialchars($odeme['odeme_durumu']) .
                " | <strong>Tür ID:</strong> " . htmlspecialchars($odeme['odeme_turu_id']) . "</li>";
        }
        echo "</ul><hr>";
    }

    // 7. İzin türleri
    if ($stmt->more_results() && $stmt->next_result()) {
        $result = $stmt->get_result();
        echo "<h6>İzin Türleri:</h6><ul>";
        while ($tur = $result->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($tur['izin_turu_adi']) . "</strong> - " .
                htmlspecialchars($tur['izin_suresi']) . " gün | Açıklama: " .
                htmlspecialchars($tur['aciklama']) . " | Oluşturulma: " .
                htmlspecialchars($tur['olusturulma_tarihi']) . "</li>";
        }
        echo "</ul><hr>";
    }

   

    $stmt->close();
    $conn->close();
}
?>

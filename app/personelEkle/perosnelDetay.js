function personelDetayGoster(id) {
  $.ajax({
    url: "personelDetay.php",
    type: "POST",
    data: { id: id },
    success: function (response) {
      var result = JSON.parse(response);
      if (result.status === "success") {
        var p = result.data;

        var detayHtml = `
            <div class="text-center">
              <img src="data:image/jpeg;base64,${p.fotograf}" class="img-fluid rounded mb-3" style="max-width: 200px;">
            </div>
            <p><strong>Ad Soyad:</strong> ${p.ad_Soyad}</p>
            <p><strong>Doğum Tarihi:</strong> ${p.dogum_Tarihi}</p>
            <p><strong>Cinsiyet:</strong> ${p.cinsiyet}</p>
            <p><strong>Kan Grubu:</strong> ${p.kan_Grubu}</p>
            <p><strong>Durumu:</strong> ${p.durumu}</p>
            <p><strong>E-Posta:</strong> ${p.eposta_adresi}</p>
            <p><strong>Telefon:</strong> ${p.telefon_no}</p>
            <p><strong>Departman:</strong> ${p.departman_Adı}</p>
            <p><strong>Departman Kodu:</strong> ${p.departman_Kodu}</p>
            <p><strong>İş Başlama Tarihi:</strong> ${p.is_Baslama_Tarihi}</p>
            <p><strong>İş Durumu:</strong> ${p.is_Durumu}</p>
            <p><strong>Çalışan Sayısı:</strong> ${p.calisan_Sayisi}</p>
            <p><strong>Departman Açıklaması:</strong> ${p.aciklama}</p>
  
            <h5>İzinler</h5>
            <p><strong>İzin Türü:</strong> ${p.izin_turu_adi}</p>
            <p><strong>İzin Açıklaması:</strong> ${p.izin_aciklamasi}</p>
            <p><strong>İzin Tarihleri:</strong> ${p.izin_tarihleri}</p>
            <p><strong>Başlangıç Tarihi:</strong> ${p.baslangic_tarihi}</p>
            <p><strong>Bitiş Tarihi:</strong> ${p.bitis_tarihi}</p>
            <p><strong>Toplam Gün:</strong> ${p.toplam_gun}</p>
            <p><strong>İzin Onay Durumu:</strong> ${p.izin_onay_durumu}</p>
  
            <h5>Maaş ve Ödeme</h5>
            <p><strong>Ödeme Tutarı:</strong> ${p.odeme_tutari} ₺</p>
            <p><strong>Ödeme Tarihi:</strong> ${p.odeme_tarihi}</p>
            <p><strong>Ödeme Durumu:</strong> ${p.odeme_durumu}</p>
  
            <h5>Pozisyon</h5>
            <p><strong>Pozisyon Adı:</strong> ${p.pozisyon_adı}</p>
            <p><strong>Tecrübe Yılı:</strong> ${p.tecrübe_yılı}</p>
            <p><strong>Eğitim Seviyesi:</strong> ${p.eğitim_seviyesi}</p>
            <p><strong>Pozisyon Tipi:</strong> ${p.pozisyon_tipi}</p>
            <p><strong>Yetki Durumu:</strong> ${p.yetki_durumu}</p>
  
          `;

        $("#modalDetayIcerik").html(detayHtml);
        $("#personelDetayModal").modal("show");
      } else {
        alert("Hata: " + result.message);
      }
    },
    error: function (xhr) {
      alert("Personel bilgileri alınamadı.");
      console.error(xhr.responseText);
    },
  });
}

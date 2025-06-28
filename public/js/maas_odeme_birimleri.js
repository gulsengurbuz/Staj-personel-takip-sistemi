document.addEventListener("DOMContentLoaded", function () {
  fetch("../../app/Controllers/maas_odeme_birimleri.php") // PHP dosyanın yolu
    .then((res) => res.json())
    .then((data) => {
      // Sayıları güncelle
      document.getElementById("toplamPersonelSayi").textContent =
        data.toplam_personel ?? 0;
      document.getElementById("buAyOdenenSayi").textContent = `₺${(
        data.bu_ay_odenen ?? 0
      ).toLocaleString("tr-TR")}`;
      document.getElementById("bekleyenOdemeSayi").textContent = `₺${(
        data.bekleyen_odeme ?? 0
      ).toLocaleString("tr-TR")}`;

      // Opsiyonel: Progress bar oranları (örnek)
      const toplam = (data.bu_ay_odenen ?? 0) + (data.bekleyen_odeme ?? 0);
      const odenenYuzde = toplam ? (data.bu_ay_odenen / toplam) * 100 : 0;
      const bekleyenYuzde = toplam ? (data.bekleyen_odeme / toplam) * 100 : 0;

      document.querySelector(
        ".progress-bar.bg-warning"
      ).style.width = `${odenenYuzde.toFixed(1)}%`;
      document.querySelector(
        ".progress-bar.bg-danger"
      ).style.width = `${bekleyenYuzde.toFixed(1)}%`;
    })
    .catch((error) => {
      console.error("Gösterge verileri alınamadı:", error);
    });
});

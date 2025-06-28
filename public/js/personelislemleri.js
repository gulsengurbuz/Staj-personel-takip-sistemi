document.addEventListener("DOMContentLoaded", function () {
  // Detay Göster
  document.querySelectorAll(".detayGosterBtn").forEach(function (button) {
    button.addEventListener("click", function () {
      const id = this.dataset.id;
      const adSoyad = this.dataset.adsoyad;
      const departman = this.dataset.departman;
      const pozisyon = this.dataset.pozisyon;
      const maas = this.dataset.maas;

      document.querySelector(
        "#personelDetayModal .modal-title"
      ).textContent = `${adSoyad} - Maaş Detayları`;
      document.querySelector("#personelDetayModal .fw-medium").textContent =
        adSoyad;
      document.querySelector(
        "#personelDetayModal .text-muted"
      ).textContent = `ID: ${id}`;
      document.querySelector(
        "#personelDetayModal .badge.bg-success"
      ).textContent = "Aktif";
      document.querySelector(
        "#personelDetayModal .text-success"
      ).textContent = `₺${maas}`;
    });
  });

  // Maaş Güncelle
  document.querySelectorAll(".maasGuncelleBtn").forEach(function (button) {
    button.addEventListener("click", function () {
      document.getElementById("personelAdi").value = this.dataset.adsoyad;
      document.getElementById("mevcutMaas").value = this.dataset.maas;
    });
  });

  // Ödeme Yap
  document.querySelectorAll(".odemeYapBtn").forEach(function (button) {
    button.addEventListener("click", function () {
      document.getElementById("odemePersonel").value = this.dataset.adsoyad;
      document.getElementById("odemeTutari").value = this.dataset.maas;
    });
  });

  // Ödeme Geçmişi
  document.querySelectorAll(".odemeGecmisiBtn").forEach(function (button) {
    button.addEventListener("click", function () {
      document.querySelector(
        "#odemeGecmisiModal h5"
      ).textContent = `Ödeme Geçmişi - ${this.dataset.adsoyad}`;
    });
  });
});

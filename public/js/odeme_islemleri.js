document.addEventListener("DOMContentLoaded", function () {
  fetch("../../app/Controllers/odeme_islemleri.php")
    .then((res) => {
      if (!res.ok) {
        throw new Error(
          "Sunucudan geçerli yanıt alınamadı. HTTP Durumu: " + res.status
        );
      }
      return res.json();
    })
    .then((data) => {
      document.getElementById("maasSayisi").textContent = data.maas ?? 0;
      document.getElementById("primSayisi").textContent = data.prim ?? 0;
      document.getElementById("avansSayisi").textContent = data.avans ?? 0;
      document.getElementById("mesaiSayisi").textContent = data.mesai ?? 0;
      document.getElementById("tazminatSayisi").textContent =
        data.tazminat ?? 0;
    })
    .catch((err) => {
      console.error("Ödeme istatistikleri alınamadı:", err.message);
    });
});

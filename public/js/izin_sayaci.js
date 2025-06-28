document.addEventListener("DOMContentLoaded", function () {
  // Sayfa yüklendiğinde sayıları çek
  fetch("/gulsen/Personel_Takip_Sistemi/app/Controllers/izin_sayaci.php")
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("onaylandiSayisi").textContent = data.onaylandi;
      document.getElementById("reddedildiSayisi").textContent = data.reddedildi;
      document.getElementById("bekleyenSayisi").textContent = data.bekleyen;
    })
    .catch((error) => {
      console.error("Veri alınamadı:", error);
    });
});

document.addEventListener("DOMContentLoaded", function () {
  fetch("../../app/Controllers/personelTalepSayisi.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        document.getElementById("personelSayiBadge").innerText =
          data.personel_sayi;
      } else {
        console.error("Sunucu hatası:", data.message);
        document.getElementById("personelSayiBadge").innerText = "!";
      }
    })
    .catch((error) => {
      console.error("Veri alınamadı:", error);
      document.getElementById("personelSayiBadge").innerText = "!";
    });
});

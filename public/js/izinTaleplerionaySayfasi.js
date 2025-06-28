document.addEventListener("DOMContentLoaded", function () {
  fetch("../../app/Controllers/bekleyenIzin.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        document.getElementById("izinSayiBadge").innerText = data.izin_sayi;
        document.getElementById("odemeSayiBadge").innerText = data.odeme_sayi;
      } else {
        console.error("Sunucu hatası:", data.message);
      }
    })
    .catch((error) => {
      console.error("Talepler alınamadı:", error);
    });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".detay-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const selectedPersonelId = this.getAttribute("data-personel-id");
      console.log("Seçilen personel ID:", selectedPersonelId);

      const modalBodyContent = document.getElementById("modalBodyContent");
      if (!modalBodyContent) {
        console.error("modalBodyContent bulunamadı!");
        return;
      }

      modalBodyContent.innerHTML = "<p>Yükleniyor...</p>";

      fetch(
        "/gulsen/Personel_Takip_Sistemi/app/Controllers/personelDetayGosterme.php",
        {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `personel_id=${encodeURIComponent(selectedPersonelId)}`,
        }
      )
        .then((response) => response.text())
        .then((html) => {
          modalBodyContent.innerHTML = html;
        })
        .catch((error) => {
          console.error("Detay verisi alınamadı:", error);
          modalBodyContent.innerHTML = "<p>Detaylar yüklenemedi.</p>";
        });
    });
  });
});

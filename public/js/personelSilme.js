let selectedPersonelId = null;

// Modalı açan butonlara tıklama işlemi
document
  .querySelectorAll("button[data-bs-target='#exampleModal']")
  .forEach((button) => {
    button.addEventListener("click", function () {
      selectedPersonelId = this.getAttribute("data-personel-id");
      console.log("Seçilen personel ID:", selectedPersonelId);

      // Modal açıldığında, silme butonuna ID'yi aktar
      const deleteBtn = document.getElementById("deleteBtn");
      if (deleteBtn) {
        deleteBtn.setAttribute("data-personel-id", selectedPersonelId);
      }
    });
  });

// Silme işlemini yakalayan event delegation yöntemi
document.addEventListener("click", function (event) {
  if (event.target && event.target.id === "deleteBtn") {
    const personelId = event.target.getAttribute("data-personel-id");

    console.log("Silme işlemi başlatılıyor. Personel ID:", personelId);

    if (!personelId) {
      console.error("HATA: Personel ID alınamadı.");
      return;
    }

    fetch(
      "/gulsen/Personel_Takip_Sistemi/app/Controllers/personelSilme.php?id=" +
        personelId
    )
      .then((response) => {
        console.log("Fetch isteği yapıldı. HTTP Durum Kodu:", response.status);

        if (!response.ok) {
          console.error("Sunucu HTTP hatası:", response.status);
          throw new Error("Sunucu hatası: " + response.status);
        }

        return response.text();
      })
      .then((responseText) => {
        console.log("Sunucudan gelen yanıt (text):", responseText);

        try {
          const jsonResponse = JSON.parse(responseText);
          console.log("Sunucudan gelen yanıt (JSON):", jsonResponse);
        } catch (e) {
          console.warn("Yanıt JSON formatında değil ya da çözümlenemedi.");
        }

        // Modal kapatılır
        const modalEl = document.getElementById("exampleModal");
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
          modal.hide();
          console.log("Modal kapatıldı.");
        }
      })
      .catch((error) => {
        console.error("Fetch işleminde yakalanan hata:", error.message);
      });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  document.body.addEventListener("click", function (e) {
    if (e.target.classList.contains("detay-btn")) {
      const personelId = e.target.getAttribute("data-id");

      fetch(`../../app/Controllers/odemeDetay.php?id=${personelId}`)
        .then((response) => {
          if (!response.ok) throw new Error("HTTP hatası");
          return response.text();
        })
        .then((html) => {
          document.querySelector(
            "#personelDetayModal .modal-content"
          ).innerHTML = html;

          const modalEl = document.getElementById("personelDetayModal");
          const modal = new bootstrap.Modal(modalEl);
          modal.show();
        })
        .catch((err) => {
          console.error("Detaylar yüklenemedi:", err);
          alert("Detaylar yüklenirken bir hata oluştu.");
        });
    }
  });
});

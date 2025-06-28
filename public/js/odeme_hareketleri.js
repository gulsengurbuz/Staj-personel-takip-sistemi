document.addEventListener("DOMContentLoaded", function () {
  const listContainer = document.querySelector("#sonOdemeListesi");
  if (!listContainer) {
    console.error("HATA: #sonOdemeListesi elementi bulunamadı.");
    return;
  }

  fetch("../../app/Controllers/odeme_hareketleri.php")
    .then((res) => res.json())
    .then((data) => {
      listContainer.innerHTML = "";

      data.forEach((item) => {
        const listItem = document.createElement("div");
        listItem.className = "list-group-item";

        listItem.innerHTML = `
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="mb-1">${item.ad_Soyad}</h6>
              <p class="text-muted small mb-0">${item.odeme_turu}</p>
            </div>
            <div class="text-end">
              <span class="fw-bold text-success">₺${parseFloat(
                item.odeme_tutari
              ).toLocaleString("tr-TR")}</span>
              <p class="text-muted small mb-0">${item.odeme_tarihi}</p>
            </div>
          </div>
        `;

        listContainer.appendChild(listItem);
      });
    })
    .catch((err) => console.error("Son ödeme hareketleri yüklenemedi:", err));
});

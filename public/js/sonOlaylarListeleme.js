fetch("../../app/Controllers/getSonOlaylar.php")
  .then((res) => res.json())
  .then((veriler) => {
    const liste = document.querySelector("#sonOnayListesi");
    liste.innerHTML = "";

    veriler.forEach((item) => {
      const renk = item.durum === "Onaylandı" ? "success" : "danger";
      const icon = item.durum === "Onaylandı" ? "check" : "times";

      const satir = `
        <div class="list-group-item">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <div class="avatar me-3 bg-${renk} text-white rounded-circle text-center" style="width: 40px; height: 40px; line-height: 40px">
                <i class="fas fa-${icon}"></i>
              </div>
              <div>
                <div class="fw-medium">${item.ad_soyad}'ın ${
        item.kategori
      } talebi ${item.durum.toLowerCase()}</div>
                <div class="small text-muted">${new Date(
                  item.tarih
                ).toLocaleString("tr-TR")}</div>
              </div>
            </div>
            <span class="badge bg-${renk}">${item.durum}</span>
          </div>
        </div>
      `;
      liste.insertAdjacentHTML("beforeend", satir);
    });
  });

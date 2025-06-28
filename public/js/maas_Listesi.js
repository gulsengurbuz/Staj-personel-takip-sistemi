document.addEventListener("DOMContentLoaded", function () {
  fetch("../../app/Controllers/maas_listesi.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector("tbody");
      tbody.innerHTML = "";

      data.forEach((personel) => {
        const initials = personel.ad_Soyad
          .split(" ")
          .map((x) => x[0])
          .join("")
          .toUpperCase();

        const durumBadge =
          personel.odeme_durumu === "Ödendi"
            ? '<span class="badge bg-success">Ödendi</span>'
            : '<span class="badge bg-danger">Beklemede</span>';

        const rowHTML = `
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="avatar me-2 bg-primary text-white rounded-circle text-center" style="width: 40px; height: 40px; line-height: 40px">
                  ${initials}
                </div>
                <div>
                  <div class="fw-medium">${personel.ad_Soyad}</div>
                  <div class="small text-muted">ID: ${
                    personel.personel_id
                  }</div>
                </div>
              </div>
            </td>
            <td>${personel.departman_adi}</td>
            <td>${personel.pozisyon_adi}</td>
            <td>₺${parseFloat(personel.net_maas).toLocaleString("tr-TR")}</td>
            <td>${personel.son_odeme_tarihi ?? "-"}</td>
            <td>${durumBadge}</td>
            <td class="text-end">
         <button 
        class="btn btn-sm btn-outline-secondary detay-btn" 
        data-id="${personel.personel_id}">
        Detay
      </button>


            
            </td>
          </tr>
        `;

        tbody.insertAdjacentHTML("beforeend", rowHTML);
      });

      // ✅ Bootstrap dropdownları manuel başlat
      if (typeof bootstrap !== "undefined" && bootstrap.Dropdown) {
        const dropdownButtons = tbody.querySelectorAll(
          '[data-bs-toggle="dropdown"]'
        );
        dropdownButtons.forEach((btn) => {
          new bootstrap.Dropdown(btn);
        });
      } else {
        console.error("Bootstrap JS yüklenmedi veya tanımlı değil!");
      }
    })
    .catch((err) => {
      console.error("Personel maaş listesi verisi alınamadı:", err);
    });
});

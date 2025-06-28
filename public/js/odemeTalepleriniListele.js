document.addEventListener("DOMContentLoaded", () => {
  fetch("../../app/Controllers/getirOdemeTalepOnay.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector("#odemeTableBody");
      tbody.innerHTML = "";

      data.forEach((item) => {
        const adBasHarf = item.ad_soyad
          .split(" ")
          .map((x) => x[0])
          .join("")
          .toUpperCase()
          .slice(0, 2);

        const row = `
          <tr data-id="${item.odeme_id}">
            <td>
              <input type="checkbox" name="odemeSec" data-id="${
                item.odeme_id
              }" />
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="avatar me-2 bg-primary text-white rounded-circle text-center" 
                     style="width: 36px; height: 36px; line-height: 36px;">
                  ${adBasHarf}
                </div>
                <div>
                  <div class="fw-medium">${item.ad_soyad}</div>
                </div>
              </div>
            </td>
            <td>${item.odeme_turu_adi}</td>
            <td>₺${item.odeme_tutari}</td>
            <td>${item.odeme_tarihi}</td>
            <td>${item.odeme_talep_tarihi || "-"}</td>
            <td>${item.odeme_aciklamasi || "-"}</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-eye"></i></button>
              <button class="btn btn-sm btn-outline-success me-1" data-id="${
                item.odeme_id
              }"><i class="fas fa-check"></i></button>
              <button class="btn btn-sm btn-outline-danger" data-id="${
                item.odeme_id
              }"><i class="fas fa-times"></i></button>
            </td>
          </tr>
        `;
        tbody.insertAdjacentHTML("beforeend", row);
      });
    });

  document
    .getElementById("odemeTopluOnaylaBtn")
    .addEventListener("click", () => {
      const idler = getSeciliOdemeIDler();
      if (idler.length === 0) return alert("Lütfen en az bir ödeme seçin.");

      fetch("../../app/Controllers/odemeDurumGuncelleme.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ odemeIDler: idler, durum: "Onaylandı" }),
      })
        .then((res) => res.json())
        .then((data) => {
          alert(data.mesaj || "İşlem tamamlandı.");
          idler.forEach((id) => {
            const row = document.querySelector(`tr[data-id='${id}']`);
            if (row) row.remove();
          });
        });
    });

  document
    .getElementById("odemeTopluReddetBtn")
    .addEventListener("click", () => {
      const idler = getSeciliOdemeIDler();
      if (idler.length === 0) return alert("Lütfen en az bir ödeme seçin.");

      fetch("../../app/Controllers/odemeDurumGuncelleme.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ odemeIDler: idler, durum: "Reddedildi" }),
      })
        .then((res) => res.json())
        .then((data) => {
          alert(data.mesaj || "İşlem tamamlandı.");
          idler.forEach((id) => {
            const row = document.querySelector(`tr[data-id='${id}']`);
            if (row) row.remove();
          });
        });
    });
});

function getSeciliOdemeIDler() {
  const secilenler = document.querySelectorAll(
    'input[name="odemeSec"]:checked'
  );
  return Array.from(secilenler).map((cb) => cb.getAttribute("data-id"));
}
let seciliOdemeId = null;

// Modal açma: onayla butonuna tıklanınca
document.addEventListener("click", function (e) {
  if (e.target.closest(".btn-outline-success[data-id]")) {
    seciliOdemeId = e.target.closest("button").getAttribute("data-id");
    const modal = new bootstrap.Modal(
      document.getElementById("odemeOnaylaModal")
    );
    modal.show();
  }
});

// Modal açma: reddet butonuna tıklanınca
document.addEventListener("click", function (e) {
  if (e.target.closest(".btn-outline-danger[data-id]")) {
    seciliOdemeId = e.target.closest("button").getAttribute("data-id");
    const modal = new bootstrap.Modal(
      document.getElementById("odemeReddetModal")
    );
    modal.show();
  }
});

// Onayla Modalındaki Onay butonu
document.getElementById("modalOdemeOnaylaBtn").addEventListener("click", () => {
  if (!seciliOdemeId) return;
  fetch("../../app/Controllers/odemeDurumGuncelleme.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ odemeIDler: [seciliOdemeId], durum: "Onaylandı" }),
  })
    .then((res) => res.json())
    .then((data) => {
      alert(data.mesaj || "Ödeme onaylandı.");
      document.querySelector(`tr[data-id='${seciliOdemeId}']`)?.remove();
      bootstrap.Modal.getInstance(
        document.getElementById("odemeOnaylaModal")
      ).hide();
      seciliOdemeId = null;
    });
});

// Reddet Modalındaki Reddet butonu
document.getElementById("modalOdemeReddetBtn").addEventListener("click", () => {
  if (!seciliOdemeId) return;
  fetch("../../app/Controllers/odemeDurumGuncelleme.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ odemeIDler: [seciliOdemeId], durum: "Reddedildi" }),
  })
    .then((res) => res.json())
    .then((data) => {
      alert(data.mesaj || "Ödeme reddedildi.");
      document.querySelector(`tr[data-id='${seciliOdemeId}']`)?.remove();
      bootstrap.Modal.getInstance(
        document.getElementById("odemeReddetModal")
      ).hide();
      seciliOdemeId = null;
    });
});

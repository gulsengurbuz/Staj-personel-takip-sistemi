document.addEventListener("DOMContentLoaded", () => {
  fetch("../../app/Controllers/getirPersonelTalepleri.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector("#talepTableBody");
      tbody.innerHTML = "";

      data.forEach((item) => {
        const adBasHarf = item.ad_soyad
          .split(" ")
          .map((x) => x[0])
          .join("")
          .toUpperCase()
          .slice(0, 2);

        const row = `
          <tr data-id="${item.talep_id}">
            <td>
              <input type="checkbox" name="talepSec" data-id="${
                item.talep_id
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
            <td>${item.talep_tipi}</td>
            <td>${item.talep_tarihi}</td>
            <td>${item.aciklama || "-"}</td>
            <td>${item.created_at}</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-eye"></i></button>
              <button class="btn btn-sm btn-outline-success me-1" data-id="${
                item.talep_id
              }"><i class="fas fa-check"></i></button>
              <button class="btn btn-sm btn-outline-danger" data-id="${
                item.talep_id
              }"><i class="fas fa-times"></i></button>
            </td>
          </tr>
        `;
        tbody.insertAdjacentHTML("beforeend", row);
      });
    });

  document
    .getElementById("talepTopluOnaylaBtn")
    .addEventListener("click", () => {
      const idler = getSeciliTalepIDler();
      if (idler.length === 0) return alert("Lütfen en az bir talep seçin.");

      fetch("../../app/Controllers/personeltalepDurumGuncelle.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ talepIDler: idler, durum: "Onaylandı" }),
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
    .getElementById("talepTopluReddetBtn")
    .addEventListener("click", () => {
      const idler = getSeciliTalepIDler();
      if (idler.length === 0) return alert("Lütfen en az bir talep seçin.");

      fetch("../../app/Controllers/personeltalepDurumGuncelle.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ talepIDler: idler, durum: "Reddedildi" }),
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

function getSeciliTalepIDler() {
  const secilenler = document.querySelectorAll(
    'input[name="talepSec"]:checked'
  );
  return Array.from(secilenler).map((cb) => cb.getAttribute("data-id"));
}

let seciliTalepId = null;

document.addEventListener("click", function (e) {
  if (e.target.closest(".btn-outline-success[data-id]")) {
    seciliTalepId = e.target.closest("button").getAttribute("data-id");
    const modal = new bootstrap.Modal(
      document.getElementById("talepOnaylaModal")
    );
    modal.show();
  }
});

document.addEventListener("click", function (e) {
  if (e.target.closest(".btn-outline-danger[data-id]")) {
    seciliTalepId = e.target.closest("button").getAttribute("data-id");
    const modal = new bootstrap.Modal(
      document.getElementById("talepReddetModal")
    );
    modal.show();
  }
});

document.getElementById("modalTalepOnaylaBtn").addEventListener("click", () => {
  if (!seciliTalepId) return;
  fetch("../../app/Controllers/personeltalepDurumGuncelle.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ talepIDler: [seciliTalepId], durum: "Onaylandı" }),
  })
    .then((res) => res.json())
    .then((data) => {
      alert(data.mesaj || "Talep onaylandı.");
      document.querySelector(`tr[data-id='${seciliTalepId}']`)?.remove();
      bootstrap.Modal.getInstance(
        document.getElementById("talepOnaylaModal")
      ).hide();
      seciliTalepId = null;
    });
});

document.getElementById("modalTalepReddetBtn").addEventListener("click", () => {
  if (!seciliTalepId) return;
  fetch("../../app/Controllers/personeltalepDurumGuncelle.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ talepIDler: [seciliTalepId], durum: "Reddedildi" }),
  })
    .then((res) => res.json())
    .then((data) => {
      alert(data.mesaj || "Talep reddedildi.");
      document.querySelector(`tr[data-id='${seciliTalepId}']`)?.remove();
      bootstrap.Modal.getInstance(
        document.getElementById("talepReddetModal")
      ).hide();
      seciliTalepId = null;
    });
});

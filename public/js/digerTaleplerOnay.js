let seciliDigerTalepId = null;
document.addEventListener("DOMContentLoaded", () => {
  fetch("../../app/Controllers/getDigerTalepler.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector("#digerTaleplerTableBody");
      tbody.innerHTML = "";

      data.forEach((item) => {
        const adBasHarf = item.ad_soyad
          .split(" ")
          .map((x) => x[0])
          .join("")
          .toUpperCase()
          .slice(0, 2);

        const belgeIkon = item.belge_yolu
          ? `<a href="${item.belge_yolu}" target="_blank"><i class="fas fa-file-alt text-primary"></i></a>`
          : "-";

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
                  <div class="small text-muted">${item.pozisyon_adi}</div>
                </div>
              </div>
            </td>
            <td>${item.talep_turu}</td>
            <td>${item.talep_tarihi}</td>
            <td>${item.aciklama || "-"}</td>
            <td>${belgeIkon}</td>
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
    .getElementById("digerTopluOnaylaBtn")
    .addEventListener("click", () => {
      const idler = getseciliDigerTalepIdler();
      if (idler.length === 0) return alert("Lütfen en az bir talep seçin.");

      fetch("../../app/Controllers/digerTalepDurumGuncelleme.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ talepIDler: idler, durum: "Onaylandı" }),
      })
        .then((res) => res.json())
        .then((data) => {
          alert(data.mesaj || "Talepler onaylandı.");
          idler.forEach((id) => {
            const row = document.querySelector(`tr[data-id='${id}']`);
            if (row) row.remove();
          });
        });
    });

  document
    .getElementById("digerTopluReddetBtn")
    .addEventListener("click", () => {
      const idler = getseciliDigerTalepIdler();
      if (idler.length === 0) return alert("Lütfen en az bir talep seçin.");

      fetch("../../app/Controllers/digerTalepDurumGuncelleme.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ talepIDler: idler, durum: "Reddedildi" }),
      })
        .then((res) => res.json())
        .then((data) => {
          alert(data.mesaj || "Talepler reddedildi.");
          idler.forEach((id) => {
            const row = document.querySelector(`tr[data-id='${id}']`);
            if (row) row.remove();
          });
        });
    });
});

function getseciliDigerTalepIdler() {
  const secilenler = document.querySelectorAll(
    'input[name="talepSec"]:checked'
  );
  return Array.from(secilenler).map((cb) => cb.getAttribute("data-id"));
}

document.addEventListener("click", function (e) {
  if (e.target.closest(".btn-outline-success[data-id]")) {
    seciliDigerTalepId = e.target.closest("button").getAttribute("data-id");
    const modal = new bootstrap.Modal(
      document.getElementById("talepOnaylaModal")
    );
    modal.show();
  }
});

document.addEventListener("click", function (e) {
  if (e.target.closest(".btn-outline-danger[data-id]")) {
    seciliDigerTalepId = e.target.closest("button").getAttribute("data-id");
    const modal = new bootstrap.Modal(
      document.getElementById("talepReddetModal")
    );
    modal.show();
  }
});

document.getElementById("modalTalepOnaylaBtn").addEventListener("click", () => {
  if (!seciliDigerTalepId) return;
  fetch("../../app/Controllers/digerTalepDurumGuncelleme.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      talepIDler: [seciliDigerTalepId],
      durum: "Onaylandı",
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      alert(data.mesaj || "Talep onaylandı.");
      document.querySelector(`tr[data-id='${seciliDigerTalepId}']`)?.remove();
      bootstrap.Modal.getInstance(
        document.getElementById("talepOnaylaModal")
      ).hide();
      seciliDigerTalepId = null;
    });
});

document.getElementById("modalTalepReddetBtn").addEventListener("click", () => {
  if (!seciliDigerTalepId) return;
  fetch("../../app/Controllers/digerTalepDurumGuncelleme.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      talepIDler: [seciliDigerTalepId],
      durum: "Reddedildi",
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      alert(data.mesaj || "Talep reddedildi.");
      document.querySelector(`tr[data-id='${seciliDigerTalepId}']`)?.remove();
      bootstrap.Modal.getInstance(
        document.getElementById("talepReddetModal")
      ).hide();
      seciliDigerTalepId = null;
    });
});

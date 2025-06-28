let seciliIzinId = null;
document.addEventListener("DOMContentLoaded", () => {
  fetch("../../app/Controllers/getIzinTalepleri.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector("#izinTableBody");
      tbody.innerHTML = "";

      data.forEach((item, index) => {
        const adBasHarf = item.ad_soyad
          .split(" ")
          .map((x) => x[0])
          .join("")
          .toUpperCase()
          .slice(0, 2);

        const izinHTML = `
        <tr data-id="${item.personel_id}">
            <td>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="izinSec" data-id="${
                  item.personel_id
                }"/>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="avatar me-2 bg-primary text-white rounded-circle text-center" style="width: 36px; height: 36px; line-height: 36px">${adBasHarf}</div>
                <div>
                  <div class="fw-medium">${item.ad_soyad}</div>
                  <div class="small text-muted">${item.pozisyon_adi}</div>
                </div>
              </div>
            </td>
            <td><span class="badge bg-success">${item.izin_turu_adi}</span></td>
            <td>${item.baslangic_tarihi}</td>
            <td>${item.bitis_tarihi}</td>
            <td>${item.toplam_gun} gün</td>
            <td>${item.izin_talep_tarihi.split(" ")[0]}</td>
            <td>${item.izin_aciklamasi}</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#izinDetayModal" data-index="${index}"><i class="fas fa-eye"></i></button>
              <button class="btn btn-sm btn-outline-success me-1"
        data-bs-toggle="modal"
        data-bs-target="#onaylaModal"
       data-id="${item.personel_id}">
  <i class="fas fa-check"></i>
</button>
<button class="btn btn-sm btn-outline-danger"
        data-bs-toggle="modal"
        data-bs-target="#reddetModal"
        data-id="${item.personel_id}">
  <i class="fas fa-times"></i>
</button>
            </td>
          </tr>
        `;
        tbody.insertAdjacentHTML("beforeend", izinHTML);
      });

      document
        .querySelectorAll('[data-bs-target="#izinDetayModal"]')
        .forEach((btn) => {
          btn.addEventListener("click", function () {
            const index = this.getAttribute("data-index");
            const item = data[index];
            document.querySelector(
              "#izinDetayModal .modal-title"
            ).innerText = `${item.ad_soyad} - İzin Talebi Detayı`;
            document.querySelector("#izinDetayModal .modal-body").innerHTML = `
            <div class="mb-3 d-flex align-items-center">
              <div class="avatar me-3 bg-primary text-white rounded-circle text-center" style="width: 50px; height: 50px; line-height: 50px; font-size: 20px;">
                ${item.ad_soyad
                  .split(" ")
                  .map((x) => x[0])
                  .join(" ")
                  .toUpperCase()}
              </div>
              <div>
                <h5 class="mb-0">${item.ad_soyad}</h5>
                <p class="text-muted mb-0">${item.pozisyon_adi}</p>
              </div>
            </div>
            <div class="card bg-light mb-3">
              <div class="card-body">
                <h6 class="card-title">İzin Bilgileri</h6>
                <div class="row mb-2"><div class="col-5 text-muted">İzin Türü:</div><div class="col-7 fw-medium">${
                  item.izin_turu_adi
                }</div></div>
                <div class="row mb-2"><div class="col-5 text-muted">Başlangıç:</div><div class="col-7 fw-medium">${
                  item.baslangic_tarihi
                }</div></div>
                <div class="row mb-2"><div class="col-5 text-muted">Bitiş:</div><div class="col-7 fw-medium">${
                  item.bitis_tarihi
                }</div></div>
                <div class="row mb-2"><div class="col-5 text-muted">Süre:</div><div class="col-7 fw-medium">${
                  item.toplam_gun
                } gün</div></div>
                <div class="row mb-2"><div class="col-5 text-muted">Talep Tarihi:</div><div class="col-7 fw-medium">${
                  item.izin_talep_tarihi.split(" ")[0]
                }</div></div>
                <div class="row mb-2"><div class="col-5 text-muted">Durum:</div><div class="col-7 fw-medium">${
                  item.izin_onay_durumu
                }</div></div>
                <div class="row mb-2"><div class="col-5 text-muted">Talep Günleri:</div><div class="col-7 fw-medium">${
                  item.izin_tarihleri
                }</div></div>
              </div>
            </div>
            <div class="mb-3"><h6>İzin Nedeni</h6><p>${
              item.izin_aciklamasi
            }</p></div>
            <div class="mb-3"><h6>Vekalet Edecek Kişi</h6><p>Belirtilmedi</p></div>
          `;
          });
        });
      document
        .querySelectorAll('[data-bs-target="#onaylaModal"]')
        .forEach((btn) => {
          btn.addEventListener("click", function () {
            seciliIzinId = this.getAttribute("data-id");
          });
          console.log("🟢 Onay butonuna tıklandı. Seçilen ID:", seciliIzinId);
        });

      document
        .querySelectorAll('[data-bs-target="#reddetModal"]')
        .forEach((btn) => {
          btn.addEventListener("click", function () {
            seciliIzinId = this.getAttribute("data-id");
          });
        });

      document
        .getElementById("modalOnaylaBtn")
        ?.addEventListener("click", () => {
          if (seciliIzinId) onaylaIzin(seciliIzinId);
        });

      document
        .getElementById("modalReddetBtn")
        ?.addEventListener("click", () => {
          if (seciliIzinId) reddetIzin(seciliIzinId);
        });
    })
    .catch((err) => {
      console.error("İzin verisi alınamadı:", err);
    });
});

// function onaylaIzin(personel_id) {
//   console.log("Gönderilen veri:", veri);
//   fetch("../../app/Controllers/izinDurumGuncelleme.php", {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json",
//     },
//     body: JSON.stringify({
//       id: personel_id,
//       durum: "Onaylandı",
//     }),
//   })
//     .then((res) => res.json())
//     .then((response) => {
//       if (response.success) {
//         const row = document.querySelector(`tr[data-id='${personel_id}']`);
//         if (row) {
//           row.remove();
//         } else {
//           console.warn(`Satır bulunamadı: ${personel_id}`);
//         }
//       } else {
//         alert("Onaylama başarısız: " + response.message);
//       }
//     })
//     .catch((err) => {
//       console.error("Hata:", err);
//       alert("İşlem sırasında hata oluştu.");
//     });
// }
function onaylaIzin(personel_id) {
  const veri = {
    personel_id: personel_id,
    durum: "Onaylandı",
  };

  console.log("Gönderilen veri:", veri); // ✅ kontrol et

  fetch("../../app/Controllers/izinDurumGuncelleme.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(veri),
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.success) {
        const row = document.querySelector(`tr[data-id='${personel_id}']`);
        if (row) {
          row.remove();
        } else {
          console.warn(`Satır bulunamadı: ${personel_id}`);
        }
      } else {
        alert("Onaylama başarısız: " + response.message);
      }
    })
    .catch((err) => {
      console.error("Hata:", err);
      alert("İşlem sırasında hata oluştu.");
    });
}

function reddetIzin(personel_id) {
  fetch("../../app/Controllers/izinDurumGuncelleme.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      personel_id: personel_id,
      durum: "Reddedildi",
    }),
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.success) {
        const row = document.querySelector(`tr[data-id='${personel_id}']`);
        if (row) {
          row.remove();
        } else {
          console.warn(`Satır bulunamadı: ${personel_id}`);
        }
      } else {
        alert("Reddetme başarısız: " + response.message);
      }
    })
    .catch((err) => {
      console.error("Hata:", err);
      alert("İşlem sırasında hata oluştu.");
    });
}

function getSeciliPersonelIdListesi() {
  const secilenler = document.querySelectorAll('input[name="izinSec"]:checked');
  const idler = Array.from(secilenler).map((cb) => cb.getAttribute("data-id"));
  return idler;
}
document.getElementById("topluOnaylaBtn").addEventListener("click", () => {
  const seciliIdler = getSeciliPersonelIdListesi();
  if (seciliIdler.length === 0) {
    alert("Lütfen en az bir izin seçin.");
    return;
  }

  // Her biri için fetch çağır
  seciliIdler.forEach((id) => {
    onaylaIzin(id);
  });
});

document.getElementById("topluReddetBtn").addEventListener("click", () => {
  const seciliIdler = getSeciliPersonelIdListesi();
  if (seciliIdler.length === 0) {
    alert("Lütfen en az bir izin seçin.");
    return;
  }

  seciliIdler.forEach((id) => {
    reddetIzin(id);
  });
});

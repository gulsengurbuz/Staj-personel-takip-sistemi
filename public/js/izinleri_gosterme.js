// izinleri_gosterme.js

document.addEventListener("DOMContentLoaded", function () {
  fetch("../../app/Controllers/izinleri_gosterme.php")
    .then((response) => response.json())
    .then((data) => {
      const bekleyenBody = document.getElementById("bekleyenTablosuBodyi");
      const onayliBody = document.getElementById("onaylanmısTableBody");
      const reddedilenBody = document.getElementById("reddedilmistabloBody");

      bekleyenBody.innerHTML = "";
      onayliBody.innerHTML = "";
      reddedilenBody.innerHTML = "";

      data.forEach((izin) => {
        const row = document.createElement("tr");

        const ortak = `
          <td>${izin.personel_id}</td>
          <td>${izin.izin_turu_id}</td>
          <td>${izin.baslangic_tarihi}</td>
          <td>${izin.bitis_tarihi}</td>
          <td>${izin.toplam_gun}</td>
          <td>${izin.izin_talep_tarihi}</td>
        `;

        if (
          izin.izin_onay_durumu === "Bekliyor" ||
          izin.izin_onay_durumu === "Beklemede"
        ) {
          row.innerHTML = `
            <td><input class="form-check-input" type="checkbox" data-id="${izin.id}" /></td>
            ${ortak}
            <td><span class="badge bg-warning">Beklemede</span></td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-info" onclick="izinDetayGoster(${izin.id})">
                <i class="fas fa-eye"></i>
              </button>
            </td>
          `;
          bekleyenBody.appendChild(row);
        } else if (izin.izin_onay_durumu === "Onaylandı") {
          row.innerHTML = `
            ${ortak}
            <td>${izin.izin_onay_tarihi || "-"}</td>
            <td>Yönetici</td>
            <td class="text-end">
             <button class="btn btn-sm btn-outline-info" onclick="izinDetayGoster(${
               izin.id
             }); aktifSekmeyiAyarla('onaylı-sekmesi')">

                <i class="fas fa-eye"></i>
              </button>
            </td>
          `;
          onayliBody.appendChild(row);
        } else if (izin.izin_onay_durumu === "Reddedildi") {
          row.innerHTML = `
            ${ortak}
            <td>${izin.izin_red_tarihi || "-"}</td>
            <td>Yönetici</td>
            <td>${izin.izin_aciklamasi || "-"}</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-info" onclick="izinDetayGoster(${
                izin.id
              }); aktifSekmeyiAyarla('reddedilmemis-sekmesi')">

                <i class="fas fa-eye"></i>
              </button>
            </td>
          `;
          reddedilenBody.appendChild(row);
        }
      });
    })
    .catch((error) => {
      console.error("İzin listesi alınamadı:", error);
    });
});

window.izinDetayGoster = function (id) {
  fetch(`../../app/Controllers/izin_detay.php?id=${id}`)
    .then((response) => response.json())
    .then((izin) => {
      const content = document.getElementById("izindetayContent");
      content.innerHTML = `
        <p><strong>Personel ID:</strong> ${izin.personel_id}</p>
        <p><strong>İzin Türü:</strong> ${izin.izin_turu_id}</p>
        <p><strong>Başlangıç:</strong> ${izin.baslangic_tarihi}</p>
        <p><strong>Bitiş:</strong> ${izin.bitis_tarihi}</p>
        <p><strong>Toplam Gün:</strong> ${izin.toplam_gun}</p>
        <p><strong>Açıklama:</strong> ${izin.izin_aciklamasi}</p>
        <p><strong>Durum:</strong> ${izin.izin_onay_durumu}</p>
        <p><strong>Talep Tarihi:</strong> ${izin.izin_talep_tarihi}</p>
        <p><strong>Onay Tarihi:</strong> ${izin.izin_onay_tarihi || "-"}</p>
        <p><strong>Red Tarihi:</strong> ${izin.izin_red_tarihi || "-"}</p>
      `;

      const modal = new bootstrap.Modal(
        document.getElementById("izinDetayModalı")
      );
      modal.show();
    })
    .catch((err) => {
      console.error("Detay verisi alınamadı:", err);
    });
};
function aktifSekmeyiAyarla(aktifId) {
  const butonlar = document.querySelectorAll("#izinyonetimiTablosu .nav-link");
  butonlar.forEach((btn) => btn.classList.remove("active"));

  const aktifButon = document.getElementById(aktifId);
  if (aktifButon) aktifButon.classList.add("active");

  const sekmeler = document.querySelectorAll(
    "#izinyonetimiTablosuContent .tab-pane"
  );
  sekmeler.forEach((tab) => tab.classList.remove("show", "active"));

  const hedefId = aktifButon?.getAttribute("data-bs-target")?.replace("#", "");
  const hedefTab = document.getElementById(hedefId);
  if (hedefTab) hedefTab.classList.add("show", "active");
}
// Seçilenleri Onayla
document
  .getElementById("secilenonaylıBtn")
  .addEventListener("click", function () {
    const secilenCheckboxlar = document.querySelectorAll(
      "#bekleyenTablosuBodyi input[type='checkbox']:checked"
    );
    const secilenIDler = Array.from(secilenCheckboxlar).map(
      (cb) => cb.dataset.id
    );

    if (secilenIDler.length === 0) {
      alert("Lütfen en az bir izin seçin.");
      return;
    }

    fetch("../../app/Controllers/izin_onaylama.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ izinIDler: secilenIDler }),
    })
      .then((res) => res.json())
      .then((cevap) => {
        alert(cevap.mesaj || "Seçilen izinler onaylandı.");
        location.reload();
      })
      .catch((err) => {
        console.error("Onaylama hatası:", err);
        alert("Onaylama sırasında bir hata oluştu.");
      });
  });
// Seçilenleri Reddet
document
  .getElementById("secilenreddetBtn")
  .addEventListener("click", function () {
    const secilenCheckboxlar = document.querySelectorAll(
      "#bekleyenTablosuBodyi input[type='checkbox']:checked"
    );
    const secilenIDler = Array.from(secilenCheckboxlar).map(
      (cb) => cb.dataset.id
    );

    if (secilenIDler.length === 0) {
      alert("Lütfen en az bir izin seçin.");
      return;
    }

    const aciklama = prompt("Red nedeni giriniz:");
    if (!aciklama) {
      alert("Red açıklaması zorunludur.");
      return;
    }

    fetch("../../app/Controllers/izin_reddetme.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ izinIDler: secilenIDler, aciklama }),
    })
      .then((res) => res.json())
      .then((cevap) => {
        alert(cevap.mesaj || "Seçilen izinler reddedildi.");
        location.reload();
      })
      .catch((err) => {
        console.error("Reddetme hatası:", err);
        alert("Reddetme sırasında bir hata oluştu.");
      });
  });

document.addEventListener("DOMContentLoaded", function () {
  destekTalepleriniGetir();

  // Talep gönderme butonu
  document
    .querySelector("#izingondermeBtn")
    .addEventListener("click", talepGonder);
});

// Tüm talepleri listele
function destekTalepleriniGetir() {
  fetch("../../app/Controllers/talepGetir.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector("tbody");
      tbody.innerHTML = "";

      data.forEach((talep) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>#${talep.talep_id}</td>
          <td>${talep.konu}</td>
          <td>${talep.olusturan_adi}</td>
          <td>${talep.olusturma_tarihi}</td>
          <td><span class="badge bg-${talep.durum_rengi}">${talep.durum}</span></td>
          <td>
            <button class="btn btn-sm btn-outline-primary detay-btn" data-talep-id="${talep.talep_id}">
              <i class="fas fa-eye"></i>
            </button>
          </td>`;
        tbody.appendChild(tr);
      });

      // Listelemeden sonra butonlara event ekle
      document.querySelectorAll(".detay-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
          const talepId = this.getAttribute("data-talep-id");
          talepDetaylariniGetir(talepId);
        });
      });
    })
    .catch((error) => {
      console.error("Talepler alınamadı:", error);
    });
}

// Talep gönderme işlemi
function talepGonder() {
  const formData = new FormData();
  formData.append("konu", document.getElementById("talepKonu").value);
  formData.append("kategori", document.getElementById("talepKategori").value);
  formData.append("oncelik", document.getElementById("talepOncelik").value);
  formData.append("aciklama", document.getElementById("talepAciklama").value);
  formData.append(
    "olusturan_adi",
    document.getElementById("olusturanAdi").value
  );

  const files = document.getElementById("talepDosya").files;
  for (let i = 0; i < files.length; i++) {
    formData.append("ekler[]", files[i]);
  }

  fetch("../../app/Controllers/talepEkle.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.success) {
        alert("Talep başarıyla eklendi!");
        document.getElementById("yeniTalepModal").querySelector("form").reset();
        bootstrap.Modal.getInstance(
          document.getElementById("yeniTalepModal")
        ).hide();
        destekTalepleriniGetir();
      } else {
        alert("Talep gönderilemedi: " + response.message);
      }
    });
}

// Detay getir ve modalı dinamik oluştur
function talepDetaylariniGetir(talepId) {
  fetch(`../../app/Controllers/destekTalepDetay.php?id=${talepId}`)
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        const talep = data.data;

        // Önce eski modal varsa kaldıralım
        const eskiModal = document.getElementById("talepDetayModal");
        if (eskiModal) eskiModal.remove();

        // Modalın HTML'ini oluştur
        const modalHTML = `
          <div class="modal fade" id="talepDetayModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Destek Talebi #${talep.talep_id}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="d-flex justify-content-between mb-3">
                    <h5>${talep.konu}</h5>
                    <span class="badge ${durumRenk(talep.durum)}">${
          talep.durum
        }</span>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <div class="mb-2"><strong>Oluşturan:</strong> ${
                        talep.olusturan_adi
                      }</div>
                      <div class="mb-2"><strong>Tarih:</strong> ${
                        talep.olusturma_tarihi
                      }</div>
                      <div><strong>Kategori:</strong> ${talep.kategori}</div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-2"><strong>Öncelik:</strong> <span class="badge bg-danger">${
                        talep.oncelik
                      }</span></div>
                      <div class="mb-2"><strong>Atanan:</strong> ${
                        talep.atanan_adi ?? "Henüz Atanmadı"
                      }</div>
                      <div><strong>Son Güncelleme:</strong> ${
                        talep.son_guncelleme
                      }</div>
                    </div>
                  </div>
                  <div class="card bg-light mb-4">
                    <div class="card-body">
                      <h6 class="card-title">Açıklama</h6>
                      <p>${talep.aciklama}</p>
                    </div>
                  </div>

                  <h6 class="mb-3">Ekler</h6>
                  <div class="list-group mb-4">
                    ${
                      talep.ek_dosyalar && talep.ek_dosyalar.length > 0
                        ? talep.ek_dosyalar
                            .map(
                              (dosya) => `
                          <a href="../../uploads/${dosya}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div><i class="fas fa-file-alt text-secondary me-2"></i>${dosya}</div>
                            <span class="badge bg-primary rounded-pill">Dosya</span>
                          </a>`
                            )
                            .join("")
                        : `<div class="list-group-item">Ek dosya bulunmamaktadır.</div>`
                    }
                  </div>

                  <div id="yanitlarContainer"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
              </div>
            </div>
          </div>
        `;

        document.body.insertAdjacentHTML("beforeend", modalHTML);

        // Modalı aç
        var detayModal = new bootstrap.Modal(
          document.getElementById("talepDetayModal")
        );
        detayModal.show();
      } else {
        alert("Talep detayları alınamadı.");
      }
    })
    .catch((error) => {
      console.error("Hata:", error);
    });
}

// Durum renklerini ayarlayan yardımcı fonksiyon
function durumRenk(durum) {
  switch (durum) {
    case "Beklemede":
      return "bg-warning";
    case "İşlemde":
      return "bg-info";
    case "Çözüldü":
      return "bg-success";
    case "Kapatıldı":
      return "bg-danger";
    default:
      return "bg-secondary";
  }
}

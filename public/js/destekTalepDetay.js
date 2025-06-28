function detayGoster(talep_id) {
  fetch("../../api/talepDetay.php?talep_id=" + talep_id)
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        const talep = data.data;

        // Modal başlık ve genel bilgiler
        document.getElementById("talepDetayModalLabel").innerText =
          "Destek Talebi #" + talep.talep_id;
        document.querySelector("#talepDetayModal h5").innerText = talep.konu;

        // Durum badge'ini güncelle
        const durumBadge = document.querySelector("#talepDetayModal .badge");
        durumBadge.innerText = talep.durum;

        // Kategori, oluşturma tarihi, atanan kişi vs.
        document
          .querySelector("#talepDetayModal .modal-body")
          .querySelectorAll(".col-md-6")[0].innerHTML = `
                    <div class="mb-2"><strong>Oluşturan:</strong> ${talep.olusturan_adi}</div>
                    <div class="mb-2"><strong>Tarih:</strong> ${talep.olusturma_tarihi}</div>
                    <div><strong>Kategori:</strong> ${talep.kategori}</div>
                `;

        document
          .querySelector("#talepDetayModal .modal-body")
          .querySelectorAll(".col-md-6")[1].innerHTML = `
                    <div class="mb-2"><strong>Öncelik:</strong> <span class="badge bg-danger">${
                      talep.oncelik
                    }</span></div>
                    <div class="mb-2"><strong>Atanan:</strong> ${
                      talep.atanan_adi ?? "Henüz Atanmadı"
                    }</div>
                    <div><strong>Son Güncelleme:</strong> ${
                      talep.son_guncelleme
                    }</div>
                `;

        // Açıklama alanını doldur
        document.querySelector("#talepDetayModal .card-body p").innerText =
          talep.aciklama;

        // Dosya ekleri alanını temizle ve doldur
        const eklerDiv = document.querySelector("#talepDetayModal .list-group");
        eklerDiv.innerHTML = ""; // temizle

        if (talep.ek_dosyalar && talep.ek_dosyalar.length > 0) {
          talep.ek_dosyalar.forEach((dosya) => {
            eklerDiv.innerHTML += `
                            <a href="../../uploads/${dosya}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div><i class="fas fa-file-alt text-secondary me-2"></i>${dosya}</div>
                                <span class="badge bg-primary rounded-pill">Dosya</span>
                            </a>`;
          });
        } else {
          eklerDiv.innerHTML = `<div class="list-group-item">Ek dosya bulunmamaktadır.</div>`;
        }

        // Modalı aç
        var detayModal = new bootstrap.Modal(
          document.getElementById("talepDetayModal")
        );
        detayModal.show();
      } else {
        alert("Detay alınamadı: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Hata:", error);
      alert("Sunucu hatası oluştu.");
    });
}

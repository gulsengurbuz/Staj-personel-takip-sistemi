document
  .getElementById("izingondermeBtn")
  .addEventListener("click", function () {
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

    fetch("../../app/Controllers/yeniTalepEkleme.php", {
      // kendi yoluna göre güncelle
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          alert("Talep başarıyla kaydedildi. Talep ID: " + data.talep_id);
          document.getElementById("talepForm").reset();
          // Modal kapatma
          var modal = bootstrap.Modal.getInstance(
            document.getElementById("yeniTalepModal")
          );
          modal.hide();
        } else {
          alert("Hata oluştu: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Hata:", error);
        alert("İstek gönderilemedi.");
      });
  });

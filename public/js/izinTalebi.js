document
  .getElementById("izingondermeBtn")
  .addEventListener("click", function () {
    const form = document.getElementById("yeniIzınFormu");
    const formData = new FormData();

    formData.append(
      "personel_id",
      document.getElementById("personelSecimi").value
    );
    formData.append(
      "izin_turu",
      document.getElementById("izinTuruSecimi").value
    );
    formData.append(
      "baslangic_tarihi",
      document.getElementById("baslangıcTarihi").value
    );
    formData.append("bitis_tarihi", document.getElementById("sonTarihi").value);
    formData.append("izin_sebebi", document.getElementById("izinSebebi").value);

    fetch("/gulsen/Personel_Takip_Sistemi/app/Controllers/izinTalebi.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data);
        form.reset();
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("yeniizinalmaModalı")
        );
        modal.hide();
      })
      .catch((error) => {
        console.error("İstek hatası:", error);
        alert("Bir hata oluştu.");
      });
  });

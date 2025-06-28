document
  .getElementById("saveChangesduzenle")
  .addEventListener("click", function (event) {
    event.preventDefault();

    const personelId = document.getElementById("edit_id").value;
    const fotoInput = document.getElementById("modal_foto_input");
    const fotograf =
      fotoInput && fotoInput.files.length > 0 ? fotoInput.files[0] : null;

    const adSoyad = document.getElementById("edit_ad_soyad").value;
    const telefonNo = document.getElementById("edit_telefon_no").value;
    const departmanId = document.getElementById("edit_departman").value;
    const pozisyonId = document.getElementById("edit_pozisyon").value;
    const durumu = document.getElementById("edit_durum").value;

    const formData = new FormData();
    formData.append("personel_id", personelId);
    if (fotograf) {
      formData.append("fotograf", fotograf);
    }
    formData.append("ad_soyad", adSoyad);
    formData.append("telefon_no", telefonNo);
    formData.append("departman_id", departmanId);
    formData.append("pozisyon_id", pozisyonId);
    formData.append("durumu", durumu);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/Controllers/personeliGuncelle.php", true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        try {
          const response = JSON.parse(xhr.responseText);
          alert(response.message);
        } catch (e) {
          console.error("JSON parse hatası:", e);
          console.error("Sunucudan gelen:", xhr.responseText);
          alert("Sunucudan geçersiz veri geldi.");
        }
      } else {
        alert("Bir hata oluştu. Kod: " + xhr.status);
      }
    };

    /*xhr.onload = function () {
      if (xhr.status == 200) {
        const response = JSON.parse(xhr.responseText);
        alert(response.message);
      } else {
        alert("Bir hata oluştu.");
      }
    };*/

    xhr.send(formData);
  });

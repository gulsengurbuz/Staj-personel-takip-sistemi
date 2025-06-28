document.querySelectorAll(".edit-personnel-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const personelId = this.getAttribute("data-personel-id");
    fetch(
      "/gulsen/Personel_Takip_Sistemi/app/Models/personelDuzenle.php?id=" +
        personelId
    )
      .then((response) => {
        console.log(response);
        if (!response.ok) {
          console.error(`Sunucu hatası: ${response.status}`);
          throw new Error("Sunucu hatası: " + response.status);
        }
        return response.text();
      })
      .then((responseText) => {
        console.log("Sunucu yanıtı:", responseText);

        try {
          var responseJson = JSON.parse(responseText);
          return responseJson;
        } catch (e) {
          console.error(e); // error in the above string (in this case, yes)!
        }
      })
      .then((data) => {
        console.log("Dönen JSON verisi:", data);

        const base64Image = "data:image/jpeg;base64," + data.fotograf;
        document.getElementById("modal_foto").src = base64Image;
        document.getElementById("edit_id").value = data.personel_id;
        document.getElementById("edit_ad_soyad").value = data.ad_soyad;
        document.getElementById("edit_telefon_no").value = data.telefon_no;
        document.getElementById("edit_departman").value = data.departman_Adi;
        document.getElementById("edit_pozisyon").value = data.pozisyon_adi;
        document.getElementById("edit_durum").value =
          data.durumu == 1 ? "Aktif" : "Pasif";
      })
      .catch((error) => {
        console.error("Hata (catch bloğu):", error.message);
      });
  });
});

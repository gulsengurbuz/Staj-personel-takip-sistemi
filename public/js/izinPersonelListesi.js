document.addEventListener("DOMContentLoaded", function () {
  fetch(
    "/gulsen//Personel_Takip_Sistemi/app/Controllers/izinPersonelListesi.php"
  )
    .then((response) => {
      console.log("sayfaya gidiyor");
      return response.json();
    })
    .then((data) => {
      console.log("Gelen veri:", data);
      const select = document.getElementById("personelSecimi");
      select.innerHTML = `<option value="">Seçiniz</option>`;

      data.forEach((personel) => {
        const option = document.createElement("option");
        option.value = personel.personel_id;
        option.textContent = personel.ad_soyad;
        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Personel listesi alınamadı:", error);
    });
});

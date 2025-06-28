/*$(document).ready(function () {

  $(".edit-personnel-btn").on("click", function (e) {
    e.preventDefault();
    var personel_id = $(this).data("personel-id");

    $.ajax({
      url: "../app/Models/personelDuzenle.php",
      type: "GET",
      data: { personel_id: personel_id },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          let data = response.data;

          // Modal içeriğini güncelliyoruz
          $("#modal_adsoyad").text(data.ad_Soyad);
          $("#modal_telefon").text(data.telefon);
          $("#modal_departman").text(data.departman_id);
          $("#modal_pozisyon").text(data.pozisyon_id);
          $("#modal_durum").text(data.durumu);
          $("#modal_foto").attr(
            "src",
            "data:image/jpeg;base64," + data.fotograf
          );

          // Modalı gösteriyoruz
          $("#personelModal").modal("show");
        } else {
          alert("Personel bilgileri alınamadı.");
        }
      },
      error: function () {
        alert("Bir hata oluştu!");
      },
    });
  });
});
*/

$("#addPersonnelForm").submit(function (e) {
  e.preventDefault();

  var formData = new FormData(this);

  console.log("Form gönderiliyor...");
  console.log("Form Data (odeme_turu_id):", formData.get("odeme_turu_id"));

  $.ajax({
    url: "../Models/Ekleme.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      console.log("AJAX isteği başarılı!");
      console.log("Gelen cevap:", response);

      if (response.status === "success") {
        alert(response.message);
        $("#addPersonnelModal").modal("hide");
        // Tabloyu yenile
      } else {
        alert("Hata: " + response.message);
      }
    },
    error: function (xhr, status, error) {
      console.log("AJAX isteği başarısız!");
      console.log("Hata durumu:", status);
      console.log("Hata mesajı:", error);
      alert("Bir hata oluştu!");
    },
  });
});

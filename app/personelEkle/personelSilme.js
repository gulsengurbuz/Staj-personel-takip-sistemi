$(document).ready(function () {
  $(document).on("click", "[id^='sil_']", function () {
    var id = $(this).attr("id").split("_")[1];

    if (confirm("Bu personeli silmek istediğinize emin misiniz?")) {
      $.ajax({
        url: "personelSil.php",
        type: "POST",
        data: { id: id },
        success: function (response) {
          var result = JSON.parse(response);
          if (result.status === "success") {
            alert(result.message);
            location.reload();
          } else {
            alert("Hata: " + result.message);
          }
        },
        error: function (xhr) {
          alert("Silme işleminde bir hata oluştu.");
          console.error(xhr.responseText);
        },
      });
    }
  });
});

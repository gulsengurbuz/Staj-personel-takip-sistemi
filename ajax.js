function ajaxIslem(url, veri, basariliCallback, hataCallback) {
  $.ajax({
    url: url,
    type: "POST",
    data: veri,
    success: function (response) {
      var result = JSON.parse(response);
      if (result.status === "success") {
        if (basariliCallback) basariliCallback(result);
      } else {
        alert("Hata: " + result.message);
      }
    },
    error: function (xhr) {
      if (hataCallback) {
        hataCallback(xhr);
      } else {
        alert("Bir hata oluştu.");
        console.error(xhr.responseText);
      }
    },
  });
}

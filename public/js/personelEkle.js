document
  .getElementById("savePersonnelBtn")
  .addEventListener("click", function () {
    var form = document.querySelector("form");
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../personelEkle/Ekleme.php", true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          alert("Form başarıyla gönderildi!");
          if (document.getElementById("response")) {
            document.getElementById("response").innerHTML = xhr.responseText;
          }
        } else {
          alert("Bir hata oluştu: " + xhr.status);
        }
      }
    };

    xhr.send(formData);
  });

/* form id  = loginform
  tc input id =tcNo
 password input id= password
 button id = validateBtn 
 */

/*kullanıcın id lerie göre girilen tc no passwordu alıcam bunu ajax ile php ye göndereceğim. phpde veri tabanına kayıt işelmi gerçekleşicek.
 */
/*yine buradan alınan verileri php ye göndericem aam bu seferki php o kullanıcıyı veri tabanından çekicek karşılaştırma yaptıracak. doğru ise true döndürecek yanlışlık varsa falase döndürecek ona göre bende js ileya ana sayfaya yönlendirme yapacğım. yada hata mesajı döndüreceğim . */

document.getElementById("validateBtn").addEventListener(
  "click",

  function () {
    var tcNo = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();
    if (tcNo === "" || password === "") {
      alert("Lütfen TC Kimlik No ve Şifre girin!");
      return;
    }

    console.log("Gönderilen Veri:", { tcNo: tcNo, password: password });

    $.ajax({
      url: "../Controllers/bilgiKayit.php",
      method: "POST",
      data: { tcNo: tcNo, password: password },
      dataType: "json",
      success: function (response) {
        alert(JSON.stringify(response));

        if (response.success) {
          alert(response.message);
          window.location.href = "../views/personelEkle.php";
        } else {
          document.getElementById("response").innerText = response.message;
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Hatası:", error);
        console.log("Sunucudan gelen cevap:", xhr.responseText);
        document.getElementById("response").innerText =
          "Bir hata oluştu: " + xhr.responseText;
      },
    });
  }
);

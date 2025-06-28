const dogrulamaKodu = "123456";
let kodDenemeSayaci = 0;

function kodKontrol(event) {
  event.preventDefault();

  const kullaniciKodu = document.getElementById("onayKodu").value;

  if (kullaniciKodu === dogrulamaKodu) {
    alert(
      "Onay Kodu Doğrudur! Şifre Yenileme sayfasına yönlendiriliyorsunuz !"
    );
    kodDenemeSayaci = 0;
    window.location.href =
      "https://orakoglu.net/gulsen/staj_proje/Sifre_Yenileme/index.html";
  } else {
    kodDenemeSayaci++;
    alert("Onay Kodu Hatalıdır !");
    if (kodDenemeSayaci === 3) {
      alert(
        "Onay kodunu 3 defadan fazla yanlış girdiniz. Giriş sayfasına yönlendiriliyorsunuz."
      );
      window.location.href =
        "https://orakoglu.net/gulsen/staj_proje/login/index.html";
    }
  }
}

document.getElementById("kodFormu").addEventListener("submit", kodKontrol);

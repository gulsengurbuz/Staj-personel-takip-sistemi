document.getElementById("koduGönder").addEventListener("click", function () {
  var phone = document.getElementById("phone").value; // Telefon numarasını al

  if (!phone) {
    alert("Lütfen geçerli bir telefon numarası girin.");
    return;
  }

  var formData = new FormData();
  formData.append("phone", phone); // Telefon numarasını PHP'ye gönder

  fetch("send_sms.php", {
    // PHP dosyasına AJAX isteği gönder
    method: "POST",
    body: formData,
  })
    .then((response) => response.text()) // PHP'den dönen cevabı al
    .then((data) => {
      alert(data); // Gönderme işlemi başarılı veya başarısız olduğunda gösterilecek mesaj
    })
    .catch((error) => {
      console.error("SMS gönderme hatası:", error);
    });
});

document.querySelectorAll(".otp-field").forEach((input, index, inputs) => {
  const handleInput = (event) => {
    const value = event.target.value;

    // Eğer girilen değer rakam değilse, temizle
    if (value && !/^\d$/.test(value)) {
      event.target.value = ""; // Değeri sıfırla
      return;
    }

    // Diğer input'ları kontrol et, kırmızı border ekle
    inputs.forEach((otherInput) => {
      if (otherInput !== input && otherInput.value === "") {
        otherInput.style.border = "2px solid red"; // Kırmızı border
      } else {
        otherInput.style.border = ""; // Varsayılan border
      }
    });

    // Bir karakter girildiyse, bir sonraki inputa geç
    if (value.length === 1 && index < inputs.length - 1) {
      inputs[index + 1].focus();
    }

    // Eğer değer silindiyse, önceki inputa geç
    if (value.length === 0 && index > 0) {
      inputs[index - 1].focus();
    }
  };

  const handleKeyDown = (event) => {
    if (
      event.key === "Backspace" &&
      event.target.value.length === 0 &&
      index > 0
    ) {
      inputs[index - 1].focus(); // Eğer önceki inputta içerik yoksa, önceki inputa geç
    }
  };

  input.addEventListener("input", handleInput);
  input.addEventListener("keydown", handleKeyDown);
});

document.addEventListener("DOMContentLoaded", function () {
  let verifyBtn = document.getElementById("verifyBtn");
  let countdownElement = document.getElementById("countdown");
  let koduGonderBtn = document.getElementById("koduGönder");

  // Sayfa yüklendiğinde "verifyBtn" rengini sıfırla
  verifyBtn.classList.remove("btn-warning");
  verifyBtn.classList.add("btn-warning");
  verifyBtn.disabled = true; // İlk başta tıklanamaz olsun

  koduGonderBtn.addEventListener("click", function () {
    if (!koduGonderBtn.hasAttribute("data-timer-running")) {
      koduGonderBtn.setAttribute("data-timer-running", "true");

      koduGonderBtn.innerText = "Geri Sayım Başladı...";
      verifyBtn.disabled = false; // Doğrula butonunu aktif hale getir

      startCountdown(20);
    }
  });

  function startCountdown(duration) {
    let timer = duration,
      minutes,
      seconds;

    let countdownInterval = setInterval(function () {
      minutes = Math.floor(timer / 60);
      seconds = timer % 60;
      seconds = seconds < 10 ? "0" + seconds : seconds;

      countdownElement.innerHTML = `<strong>${minutes}:${seconds}</strong>`;

      if (--timer < 0) {
        clearInterval(countdownInterval);
        countdownElement.innerHTML = "<strong>Süre doldu!</strong>";

        verifyBtn.disabled = true; // Doğrula butonunu devre dışı bırak
        verifyBtn.classList.add("btn-warning"); // Rengini değiştir

        koduGonderBtn.disabled = false; // "Kodu Gönder" butonunu tekrar aktif et
        koduGonderBtn.innerText = "Kodu Gönder";
        koduGonderBtn.removeAttribute("data-timer-running");
      }
    }, 1000);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  let phoneInput = document.getElementById("phone");
  let koduGonderBtn = document.getElementById("koduGönder");
  let infoText = document.getElementById("infoText");
  let phoneError = document.getElementById("phoneError");

  phoneInput.addEventListener("input", function () {
    // Sadece rakamları al
    let phoneValue = phoneInput.value.replace(/\D/g, "");

    // Telefon numarasının uzunluğuna göre sadece rakamları kabul et
    phoneInput.value = phoneValue; // Giriş alanındaki değeri güncelle

    let phonePattern = /^5[0-9]{9}$/; // 5 ile başlayan 10 haneli telefon numarası

    // "Kodu Gönder" butonunun görünürlüğünü kontrol et
    if (phonePattern.test(phoneValue)) {
      koduGonderBtn.style.display = "block"; // Butonu göster
      phoneInput.classList.remove("is-invalid"); // Hata stilini kaldır
    } else {
      koduGonderBtn.style.display = "none"; // Butonu gizle
    }

    // Telefon numarasının uzunluğuna göre "infoText"i kontrol et
    if (phoneValue.length > 0) {
      infoText.style.display = "block"; // Info mesajını göster
    } else {
      infoText.style.display = "none"; // Info mesajını gizle
    }

    // Hatalı telefon numarası kontrolü
    if (!phonePattern.test(phoneValue)) {
      phoneInput.classList.add("is-invalid"); // Hata stilini ekle
    } else {
      phoneInput.classList.remove("is-invalid"); // Hata stilini kaldır
      phoneError.style.display = "none"; // Hata mesajını gizle
    }
  });
});

document.getElementById("name").addEventListener("input", function (event) {
  // Sadece harfleri ve boşluk karakterini kabul et
  this.value = this.value.replace(/[^A-Za-z\s]/g, "");
});

// TC Kimlik Numarası geçerliliğini kontrol etme fonksiyonu
function tcno_dogrula(tcno) {
  tcno = String(tcno);

  // TC Kimlik Numarası 11 haneli olmalı ve ilk hane 0 olmamalı
  if (tcno.substring(0, 1) === "0" || tcno.length !== 11) {
    return false;
  }

  var ilkon_array = tcno.substr(0, 10).split("");
  var ilkon_total = 0,
    hane_tek = 0,
    hane_cift = 0;

  // İlk 9 hanelerin tek ve çift indeksli rakamlarının toplamlarını ayrı ayrı hesapla
  for (var i = 0, j = 0; i < 9; ++i) {
    j = parseInt(ilkon_array[i], 10);
    if (i & 1) {
      // Çift indeksler
      hane_cift += j;
    } else {
      // Tek indeksler
      hane_tek += j;
    }
    ilkon_total += j;
  }

  // 10. hane, ilk 9 hanenin tek ve çift indeksli toplamlarının farkının 10 ile bölümünden kalan olmalı
  if ((hane_tek * 7 - hane_cift) % 10 !== parseInt(tcno.substr(-2, 1), 10)) {
    return false;
  }

  ilkon_total += parseInt(ilkon_array[9], 10);

  // 11. hane, ilk 10 hanenin toplamının 10 ile bölümünden kalan olmalı
  if (ilkon_total % 10 !== parseInt(tcno.substr(-1), 10)) {
    return false;
  }

  return true;
}

// TC Kimlik Numarası geçerliliğini kontrol etme fonksiyonu
function tcno_dogrula(tcno) {
  tcno = String(tcno);

  // TC Kimlik Numarası 11 haneli olmalı ve ilk hane 0 olmamalı
  if (tcno.substring(0, 1) === "0" || tcno.length !== 11) {
    return false;
  }

  let ilkon_array = tcno.substr(0, 10).split("");
  let ilkon_total = 0,
    hane_tek = 0,
    hane_cift = 0;

  // İlk 9 hanelerin tek ve çift indeksli rakamlarının toplamlarını ayrı ayrı hesapla
  for (let i = 0, j = 0; i < 9; ++i) {
    j = parseInt(ilkon_array[i], 10);
    if (i & 1) {
      // Çift indeksler
      hane_cift += j;
    } else {
      // Tek indeksler
      hane_tek += j;
    }
    ilkon_total += j;
  }

  // 10. hane kontrolü
  if ((hane_tek * 7 - hane_cift) % 10 !== parseInt(tcno.substr(-2, 1), 10)) {
    return false;
  }

  ilkon_total += parseInt(ilkon_array[9], 10);

  // 11. hane kontrolü
  if (ilkon_total % 10 !== parseInt(tcno.substr(-1), 10)) {
    return false;
  }

  return true;
}

// Tüm TC Kimlik Numarası doğrulaması yapılacak input alanlarını seç
document.querySelectorAll("#tcNo, #username").forEach((input) => {
  input.addEventListener("input", function () {
    let value = this.value.replace(/[^0-9]/g, ""); // Sadece rakam kabul et
    this.value = value; // Input değerini güncelle

    let tooltip = document.getElementById(this.id + "Tooltip"); // Tooltip'i belirle

    // Eğer girilen rakamlar 11 haneli değilse, kullanıcıyı uyarabiliriz
    if (value.length === 11) {
      if (tcno_dogrula(value)) {
        tooltip.style.display = "none"; // Geçerli TC Kimlik Numarası, tooltip gizlensin
        this.style.borderColor = "green"; // Kenarlık yeşil
      } else {
        tooltip.style.display = "block"; // Hatalı TC Kimlik Numarası, tooltip gösterilsin
        this.style.borderColor = "red"; // Kenarlık kırmızı
      }
    } else {
      tooltip.style.display = "none"; // Eğer 11 haneli değilse, tooltip'i gizle
      this.style.borderColor = ""; // Kenarlığı normal yap
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const passwordInput = document.getElementById("password");
  const strengthText = document.getElementById("password-strength");

  let tooltip; // Tooltip referansını saklamak için

  passwordInput.addEventListener("input", function () {
    const password = this.value;

    // Parola kriterlerini kontrol et
    const lengthCheck = password.length >= 10;
    const upperCaseCheck = /[A-Z]/.test(password);
    const lowerCaseCheck = /[a-z]/.test(password);
    const numberCheck = /[0-9]/.test(password);
    const specialCharCheck = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    let errors = [];

    if (!lengthCheck) errors.push(" En az 10 karakter uzunluğunda olmalı");
    if (!upperCaseCheck) errors.push(" En az bir büyük harf içermeli");
    if (!lowerCaseCheck) errors.push(" En az bir küçük harf içermeli");
    if (!numberCheck) errors.push(" En az bir rakam içermeli");
    if (!specialCharCheck) errors.push(" En az bir özel karakter içermeli");

    // Parola güçlü ise tooltip gizlenir, değilse gösterilir
    if (errors.length === 0) {
      strengthText.textContent = "✅ Güçlü Parola";
      strengthText.style.color = "green";
      passwordInput.style.border = "2px solid green";

      if (tooltip) tooltip.dispose(); // Tooltip varsa kaldır
    } else {
      strengthText.textContent = "❌ Zayıf Parola";
      strengthText.style.color = "red";
      passwordInput.style.border = "2px solid red";

      // Tooltip içeriğini güncelle ve göster
      passwordInput.setAttribute("title", errors.join("\n"));

      // Önceki tooltip varsa kaldır
      if (tooltip) tooltip.dispose();

      // Yeni tooltip oluştur
      tooltip = new bootstrap.Tooltip(passwordInput);
      tooltip.show(); // Tooltip'i hemen göster
    }
  });
});

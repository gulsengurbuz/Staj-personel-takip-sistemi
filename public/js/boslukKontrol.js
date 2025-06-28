document
  .getElementById("gonderBtn")
  .addEventListener("click", function (event) {
    event.preventDefault();

    // Modal ve inputları kontrol edelim
    var modal = document.getElementById("forgotPasswordModal");
    if (!modal) {
      console.error("Modal bulunamadı!");
      return; // Eğer modal bulunamazsa işlemi durdur
    }

    var inputs = modal.querySelectorAll("input"); // Modal içindeki inputları al
    if (inputs.length === 0) {
      console.error("Modal içinde input bulunamadı!");
      return;
    }

    var boşAlanlar = [];

    inputs.forEach(function (input) {
      if (input.value.trim() === "") {
        boşAlanlar.push(input.getAttribute("placeholder"));
      }
    });

    if (boşAlanlar.length > 0) {
      alert("Lütfen şu alanları doldurun:\n" + boşAlanlar.join("\n"));
    } else {
      console.log("Şifre sıfırlama işlemi başarılı!");
    }
  });

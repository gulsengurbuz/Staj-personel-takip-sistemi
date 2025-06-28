document.addEventListener("DOMContentLoaded", function () {
  const telefongiris = document.getElementById("phone");
  telefongiris.addEventListener("input", function (event) {
    let value = telefongiris.value;

    value = value.replace(/[^0-9]/g, "");

    if (/^0|90/.test(value)) {
      value = value.replace(/^0|^90/, "");
    }
    if (value.length > 10) {
      value = value.slice(0, 10);
    }
    const maxonrakam = value.replace(/\s/g, "");

    if (maxonrakam.length <= 3) {
      value = maxonrakam;
    } else if (maxonrakam.length <= 6) {
      value = maxonrakam.slice(0, 3) + " " + maxonrakam.slice(3);
    } else {
      value =
        maxonrakam.slice(0, 3) +
        " " +
        maxonrakam.slice(3, 6) +
        " " +
        maxonrakam.slice(6);
    }
    telefongiris.value = value;
  });
});

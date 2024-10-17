// script.js

function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var address = document.getElementById("address").value;

    if (name === "" || email === "" || address === "") {
        alert("Semua data harus diisi!");
    } else {
        alert("Pendaftaran berhasil!");
    }
}

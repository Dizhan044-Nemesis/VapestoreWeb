// Fungsi untuk menjumlahkan dua bilangan
function jumlah() {
    // Mengambil nilai dari input bilangan pertama dan mengonversinya menjadi tipe angka desimal (float)
    var bil1 = parseFloat(document.getElementById("bil1").value);
    
    // Mengambil nilai dari input bilangan kedua dan mengonversinya menjadi tipe angka desimal (float)
    var bil2 = parseFloat(document.getElementById("bil2").value);
    
    // Menjumlahkan kedua bilangan
    var hasil = bil1 + bil2;

    // Mengecek apakah hasilnya bukan NaN (Not a Number) atau angka valid
    if (!isNaN(hasil)) {
    
        document.getElementById("hasil").textContent = hasil;
    } else {
    
        document.getElementById("hasil").textContent = "Input tidak valid";
    }
}

// Fungsi untuk mereset input dan mengembalikan hasil ke nilai awal
function reset() {
    // Mengosongkan input bilangan pertama
    document.getElementById("bil1").value = "";
    
    // Mengosongkan input bilangan kedua
    document.getElementById("bil2").value = "";
    
    // Mengembalikan tampilan hasil penjumlahan ke 0
    document.getElementById("hasil").textContent = "0";
}

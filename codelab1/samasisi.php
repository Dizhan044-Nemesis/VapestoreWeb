<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segitiga Sama Sisi</title>
</head>
<body>

<h2>Segitiga Sama Sisi</h2>
<?php
$n = 5; // Jumlah baris

for ($i = 1; $i <= $n; $i++) {
    // Menampilkan spasi
    for ($j = $i; $j < $n; $j++) {
        echo "&nbsp;&nbsp;";
    }

    // Menampilkan bintang
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }

    // Pindah ke baris berikutnya
    echo "<br>";
}
?>

</body>
</html>
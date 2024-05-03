<?php
require_once '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO produk (nama_produk, harga) VALUES ('$nama_produk', '$harga')";

    if ($conn->query($query) === TRUE) {
        echo '<script>
            alert("Berhasil menambah data barang");
            window.location.href = "pendataan-barang.php";
        </script>';
        die;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

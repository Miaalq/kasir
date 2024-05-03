<?php
require_once '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $produk_id = $_POST['produk_id'];
  $nama_produk = $_POST['nama_produk'];
  $harga = $_POST['harga'];

  $query_update = "UPDATE produk SET nama_produk='$nama_produk', harga='$harga' WHERE produk_id=$produk_id";

  if ($conn->query($query_update) === TRUE) {
    echo '<script>
        alert("Berhasil melakukan edit data barang");
        window.location.href = "pendataan-barang.php";
      </script>';
    die;
  } else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }
}

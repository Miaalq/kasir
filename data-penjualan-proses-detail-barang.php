<?php
session_start();
require_once '../koneksi.php';
if (isset($_GET['proses'])) {
  if ($_GET['proses'] == 'tambah_barang') {
    $produk_id = $_GET['produk_id'];
    $harga_beli = $_GET['harga_jual'];
    $jumlah = $_GET['jumlah'];

    $_SESSION['tanggal_penjualan'] = $_GET['tanggal_penjualan'];
    

    $sql = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $_SESSION['penjualan_barang'][$produk_id] = [
      'produk_id' => $produk_id,
      'nama_produk' => $row['nama_produk'],
      'harga_beli' => $harga_beli,
      'jumlah' => $jumlah
    ];
    echo '<script>
          window.location.href = "data-penjualan-tambah.php";
      </script>';
    die;
  } elseif ($_GET['proses'] == 'hapus_barang') {
    if (isset($_SESSION['pebjualan_barang'][$_GET['produk_id']])) {
      unset($_SESSION['penjualan_barang'][$_GET['produk_id']]);
    }
    if (count($_SESSION['penjualan_barang']) == 0) {
      unset($_SESSION['penjualan_barang']);
    }
    echo '<script>
            window.location.href = "data-penjualan-tambah.php";
        </script>';
    die;
  }
}

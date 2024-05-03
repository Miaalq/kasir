<?php
session_start();
require_once '../koneksi.php';
if (isset($_GET['proses'])) {
  if ($_GET['proses'] == 'tambah_barang') {
    $produk_id = $_GET['produk_id'];
    $harga_beli = $_GET['harga_beli'];
    $jumlah = $_GET['jumlah'];

    $_SESSION['tanggal_pembelian'] = $_GET['tanggal_pembelian'];
    $_SESSION['nama_supplier'] = $_GET['nama_supplier'];
    $_SESSION['invoice_pembelian'] = $_GET['invoice_pembelian'];

    $sql = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $_SESSION['pembelian_barang'][$produk_id] = [
      'produk_id' => $produk_id,
      'nama_produk' => $row['nama_produk'],
      'harga_beli' => $harga_beli,
      'jumlah' => $jumlah
    ];
    echo '<script>
          window.location.href = "data-pembelian-tambah.php";
      </script>';
    die;
  } elseif ($_GET['proses'] == 'hapus_barang') {
    if (isset($_SESSION['pembelian_barang'][$_GET['produk_id']])) {
      unset($_SESSION['pembelian_barang'][$_GET['produk_id']]);
    }
    if (count($_SESSION['pembelian_barang']) == 0) {
      unset($_SESSION['pembelian_barang']);
    }
    echo '<script>
            window.location.href = "data-pembelian-tambah.php";
        </script>';
    die;
  }
}

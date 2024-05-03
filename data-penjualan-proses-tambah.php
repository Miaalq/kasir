<?php
require_once '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn->begin_transaction();
  $produk_id            = $_POST['produk_id'];
  $tanggal_penjualan    = date('Y-m-d');
  $jam_penjualan        = date('H:i:s');
  $jumlah               = $_POST['jumlah'];
  $harga                = $_POST['harga'];
  $id_user              = $_SESSION['user']['id_user'];

  $conn->begin_transaction();
  try {
    $total_harga = 0;
    foreach ($produk_id as $key => $value) {
      $total_harga  += $harga[$key] * $jumlah[$key];
    }

    $query_penjualan = "INSERT INTO penjualan (id_user_petugas, tanggal_penjualan, jam_penjualan, total_harga) VALUES ($id_user,'$tanggal_penjualan', '$jam_penjualan', $total_harga)";
    $conn->query($query_penjualan);

    $penjualan_id = $conn->insert_id;
    foreach ($produk_id as $key => $value) {
      $produk_id        = $value;
      $get_harga   = $harga[$key];
      $get_jumlah       = $jumlah[$key];

      $query_penjualan_detail = "INSERT INTO penjualan_detail(penjualan_id, produk_id, harga, jumlah) VALUES ('$penjualan_id', '$produk_id', '$get_harga', '$get_jumlah')";
      $conn->query($query_penjualan_detail);

      $query_produk = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
      $result = $conn->query($query_produk);
      $produk = $result->fetch_assoc();

      $stok_akhir = $produk['stok_tersedia'] - $jumlah[$key];
      $query_produk = "UPDATE produk SET stok_tersedia=$stok_akhir WHERE produk_id=$produk_id";
      $conn->query($query_produk);
    }

    $conn->commit();
    echo '<script>
            alert("Data berhasil disimpan");
            window.location.href = "data-penjualan.php";
        </script>';
  } catch (\Throwable $th) {
    $conn->rollback();
    $pesan =  "Data gagal disimpan : " . $th->getMessage();
    echo '<script>
        alert("' . $pesan . '");
        window.location.href = "data-penjualan-tambah.php";
    </script>';
  }
}

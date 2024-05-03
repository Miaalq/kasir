<?php
require_once '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn->begin_transaction();
  $penjualan_id         = $_POST['pembelian_id'];
  $tanggal_penjualan    = $_POST['tanggal_penjualan'];
  $produk_id            = $_POST['produk_id'];
  $harga_jual           = $_POST['harga_jual'];
  $jumlah               = $_POST['jumlah'];

  $conn->begin_transaction();
  try {
    $total_harga = 0;
    foreach ($produk_id as $key => $value) {
      $total_harga  += $harga_jual[$key] * $jumlah[$key];
    }

    $query_penjualan = "UPDATE penjualan SET tanggal_penjualan='$tanggal_penjualan',total_harga='$total_harga' WHERE penjualan_id='$penjualan_id'";
    $conn->query($query_penjualan);

    $query_hapus_penjualan_barang = "DELETE FROM pembelian_detail WHERE penjualan_id='$penjualan_id'";
    $conn->query($query_hapus_penjualan_barang);

    foreach ($produk_id as $key => $value) {
      $produk_id        = $value;
      $get_harga_beli   = $harga_beli[$key];
      $get_jumlah       = $jumlah[$key];

      $query_penjualan_detail = "INSERT INTO penjualan_detail (penjualan_id, produk_id, harga_beli, jumlah) VALUES ('$pembelian_id', '$produk_id', '$get_harga_jual', '$get_jumlah')";
      $conn->query($query_pembelian_detail);
    }

    $conn->commit();
    echo '<script>
            alert("Data berhasil diedit");
            window.location.href = "data-penjualan.php";
        </script>';
  } catch (\Throwable $th) {
    $conn->rollback();
    $pesan =  "Data gagal diedit : " . $th->getMessage();
    echo '<script>
        alert("' . $pesan . '");
        window.location.href = "data-penjualan-edit.php?id=' . $penjualan_id . '";
    </script>';
  }
}

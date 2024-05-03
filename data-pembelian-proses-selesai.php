<?php
require_once 'query-data-pembelian.php';
require_once 'query-data-barang.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pembelian_id = $_POST['pembelian_id'];
  $conn->begin_transaction();
  try {
    $update_pembelian = "UPDATE pembelian SET status = 'selesai' WHERE pembelian_id = '$pembelian_id'";
    $conn->query($update_pembelian);

    $pembelian_detail = data_pembelian_detail($pembelian_id);
    foreach ($pembelian_detail as $detail) {
      $barang = data_barang($detail['produk_id']);
      $stok_baru = $barang['stok_tersedia'] + $detail['jumlah'];
      $update_stok = "UPDATE produk SET stok_tersedia = '$stok_baru' WHERE produk_id = '$detail[produk_id]'";
      $conn->query($update_stok);
    }

    $conn->commit();
    echo '<script>
            alert("Data berhasil siselesaikan. Stok barang berhasil diperbarui.");
            window.location.href = "data-pembelian.php";
        </script>';
  } catch (\Throwable $th) {
    $conn->rollback();
    $pesan =  "Data gagal diselesaikan : " . $th->getMessage();
    echo '<script>
        alert("' . $pesan . '");
        window.location.href = "data-pembelian-selesai.php?id=' . $pembelian_id . '";
    </script>';
  }
}

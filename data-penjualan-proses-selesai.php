<?php
require_once 'query-data-penjualan.php';
require_once '../query-data-barang.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $penjualan_id = $_POST['penjualan_id'];
  $conn->begin_transaction();
  try {
    $update_penjualan = "UPDATE penjualan SET status = 'selesai' WHERE penjualan_id = '$penjualan_id'";
    $conn->query($update_penjualan);

    $pembelian_detail = data_penjualan_detail($penjualan_id);
    foreach ($penjualan_detail as $detail) {
      $barang = data_barang($detail['produk_id']);
      $stok_baru = $barang['stok_tersedia'] + $detail['jumlah'];
      $update_stok = "UPDATE produk SET stok_tersedia = '$stok_baru' WHERE produk_id = '$detail[produk_id]'";
      $conn->query($update_stok);
    }

    $conn->commit();
    echo '<script>
            alert("Data berhasil siselesaikan. Data penjualan berhasil diperbarui.");
            window.location.href = "data-penjualan.php";
        </script>';
  } catch (\Throwable $th) {
    $conn->rollback();
    $pesan =  "Data gagal diselesaikan : " . $th->getMessage();
    echo '<script>
        alert("' . $pesan . '");
        window.location.href = "data-penjualan-selesai.php?id=' . $penjualan_id . '";
    </script>';
  }
}

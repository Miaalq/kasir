<?php
require_once '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn->begin_transaction();
  $tanggal_pembelian    = $_POST['tanggal_pembelian'];
  $nama_supplier        = $_POST['nama_supplier'];
  $invoice_pembelian    = $_POST['invoice_pembelian'];
  $produk_id            = $_POST['produk_id'];
  $harga_beli           = $_POST['harga_beli'];
  $jumlah               = $_POST['jumlah'];

  $conn->begin_transaction();
  try {
    $total_harga = 0;
    foreach ($produk_id as $key => $value) {
      $total_harga  += $harga_beli[$key] * $jumlah[$key];
    }

    $query_pembelian = "INSERT INTO pembelian (tanggal_pembelian, nama_supplier, invoice_pembelian,status,total_harga) VALUES ('$tanggal_pembelian', '$nama_supplier', '$invoice_pembelian','draft',$total_harga)";
    $conn->query($query_pembelian);

    $pembelian_id = $conn->insert_id;
    foreach ($produk_id as $key => $value) {
      $produk_id        = $value;
      $get_harga_beli   = $harga_beli[$key];
      $get_jumlah       = $jumlah[$key];

      $query_pembelian_detail = "INSERT INTO pembelian_detail (pembelian_id, produk_id, harga_beli, jumlah) VALUES ('$pembelian_id', '$produk_id', '$get_harga_beli', '$get_jumlah')";
      $conn->query($query_pembelian_detail);
    }

    $conn->commit();
    echo '<script>
            alert("Data berhasil disimpan");
            window.location.href = "data-pembelian.php";
        </script>';
  } catch (\Throwable $th) {
    $conn->rollback();
    $pesan =  "Data gagal disimpan : " . $th->getMessage();
    echo '<script>
        alert("' . $pesan . '");
        window.location.href = "data-pembelian-tambah.php";
    </script>';
  }
}

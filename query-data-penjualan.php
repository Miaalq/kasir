<?php
require_once '../koneksi.php';

function data_penjualan($penjualan_id)
{
  global $conn;
  $sql    = "SELECT * FROM penjualan WHERE penjualan_id = '$penjualan_id'";
  $result = $conn->query($sql);
  return $result->fetch_assoc();
}

function data_penjualan_detail($penjualan_id)
{
  global $conn;
  $sql = "SELECT penjualan_detail.*,produk.nama_produk FROM penjualan_detail 
  JOIN produk ON penjualan_detail.produk_id = produk.produk_id
  WHERE penjualan_id = '$penjualan_id'";
  $result = $conn->query($sql);
  return $result->fetch_all(MYSQLI_ASSOC);
}

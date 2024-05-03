<?php
require_once '../koneksi.php';

function data_barang($produk_id)
{
  global $conn;
  $sql    = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
  $result = $conn->query($sql);
  return $result->fetch_assoc();
}
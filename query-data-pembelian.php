<?php
require_once '../koneksi.php';

function data_pembelian($pembelian_id)
{
  global $conn;
  $sql    = "SELECT * FROM pembelian WHERE pembelian_id = '$pembelian_id'";
  $result = $conn->query($sql);
  return $result->fetch_assoc();
}

function data_pembelian_detail($pembelian_id)
{
  global $conn;
  $sql = "SELECT pembelian_detail.*,produk.nama_produk FROM pembelian_detail 
  JOIN produk ON pembelian_detail.produk_id = produk.produk_id
  WHERE pembelian_id = '$pembelian_id'";
  $result = $conn->query($sql);
  return $result->fetch_all(MYSQLI_ASSOC);
}

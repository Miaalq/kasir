<?php
require_once 'header.php';
require_once '../koneksi.php';
$produk_id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Detail Data Stock Barang</h1>
      <h3 class="text-center mt-5 mb-4"><?php echo $row['nama_produk'] ?></h3>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="mt-1 mb-3 text-center">Riwayat Pembelian</h5>
              <hr>
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Invoice</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * 
                        FROM pembelian_detail
                        JOIN pembelian ON pembelian.pembelian_id = pembelian_detail.pembelian_id
                        WHERE produk_id = '$produk_id'
                        ORDER BY tanggal_pembelian DESC";
                  $result = $conn->query($query); ?>
                  <?php
                  $no = 1;
                  while ($row = $result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $row['tanggal_pembelian'] ?></td>
                      <td><?php echo $row['nama_supplier'] ?></td>
                      <td><?php echo $row['invoice_pembelian'] ?></td>
                      <td><?php echo rupiah($row['harga_beli']) ?></td>
                      <td><?php echo $row['jumlah'] ?></td>
                    </tr>
                  <?php
                    $no++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="mt-1 mb-3 text-center">Riwayat Penjualan</h5>
              <hr>
              <table id="datatablesSimple1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Username Petugas</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * 
                        FROM penjualan_detail
                        JOIN penjualan ON penjualan.penjualan_id = penjualan_detail.penjualan_id
                        JOIN user ON user.id_user = penjualan.id_user_petugas
                        WHERE produk_id = '$produk_id'
                        ORDER BY tanggal_penjualan DESC";
                  $result = $conn->query($query); ?>
                  <?php
                  $no = 1;
                  while ($row = $result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $row['tanggal_penjualan'] ?></td>
                      <td><?php echo $row['username'] ?></td>
                      <td><?php echo rupiah($row['harga']) ?></td>
                      <td><?php echo $row['jumlah'] ?></td>
                    </tr>
                  <?php
                    $no++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php
  $conn->close();
  ?>
  <?php require_once 'footer.php' ?>
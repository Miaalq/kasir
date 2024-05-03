<?php
require_once 'header.php';
require_once '../koneksi.php';
$id_user = $_SESSION['user']['id_user'];
?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Data Penjualan</h1>
      <a href="data-penjualan-tambah.php" class="btn btn-primary mb-3">Tambah Data</a>
      <div class="card mb-4">
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Penjualan</th>
                <th>Waktu Penjualan</th>
                <th>Tanggal penjualan</th>
                <th>Total Penjualan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM penjualan WHERE id_user_petugas=$id_user   order by penjualan_id DESC";
              $result = $conn->query($sql);
              ?>
              <?php
              $no = 1;
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $row['penjualan_id'] ?></td>
                  <td><?= $row['tanggal_penjualan'] ?></td>
                  <td><?= $row['jam_penjualan'] ?></td>
                  <td><?= rupiah($row['total_harga']) ?></td>
                  <td>
                    <a href="data-penjualan-detail.php?id=<?= $row['penjualan_id'] ?>" class="btn btn-info btn-xs mt-1"><i class="fa fa-list"></i></a>
                  </td>
                </tr>
              
                  
              <?php $no++;
              }
              $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <?php require_once 'footer.php' ?>
<?php
require_once 'header.php';
require_once '../koneksi.php';
?>
<div id="layoutSidenav_content">
  <a style="font-family: comic sans MS;">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Data Pembelian</h1>
      <a href="data-pembelian-tambah.php" class="btn btn-primary mb-3">Tambah Data</a><a style="font-family: comic sans MS;">
      <div class="card mb-4">
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Pembelian</th>
                <th>Nama Supplier</th>
                <th>Total Pembelian</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM pembelian order by tanggal_pembelian DESC";
              $result = $conn->query($sql);
              ?>
              <?php
              $no = 1;
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $row['tanggal_pembelian'] ?></td>
                  <td><?= $row['nama_supplier'] ?></td>
                  <td><?= rupiah($row['total_harga']) ?></td>
                  <td>
                    <?php
                    if ($row['status'] == 'draft') {
                      echo '<span class="badge bg-warning text-dark">Draft</span>';
                    } else {
                      echo '<span class="badge bg-success">Selesai</span>';
                    }
                    ?>
                  </td>
                  <td>
                    <?php if ($row['status'] == 'draft') { ?>
                      <a href="data-pembelian-edit.php?id=<?= $row['pembelian_id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                      <a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                      <a href="data-pembelian-selesai.php?id=<?= $row['pembelian_id'] ?>" class="btn btn-success btn-xs mt-1"><i class="fa fa-check"></i></a>
                    <?php } ?>
                    <a href="data-pembelian-detail.php?id=<?= $row['pembelian_id'] ?>" class="btn btn-info btn-xs mt-1"><i class="fa fa-list"></i></a>
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
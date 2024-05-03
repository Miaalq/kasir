<?php
require_once 'header.php';
require_once '../koneksi.php';
?>
<div id="layoutSidenav_content">
  <a style="font-family: comic sans MS;">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Data Petugas</h1>
      <a href="data-petugas-tambah.php" class="btn btn-primary mb-3">Tambah Data</a>
      <div class="card mb-4">
        <div class="card-body">
          <a style="font-family: comic sans MS;">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM user WHERE level='petugas'";
              $result = $conn->query($sql);
              ?>
              <?php
              $no = 1;
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $row['username'] ?></td>
                  <td>
                    <a href="data-petugas-edit.php?id=<?= $row['id_user'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
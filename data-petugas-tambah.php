<?php require_once 'header.php' ?>
<?php require 'proses-tambah-petugas.php';?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Tambah Data Petugas</h1>
      <a href="data-petugas.php" class="btn btn-info mb-3">Kembali</a>
      <div class="card mb-4">
        <div class="card-body">
          <form action="" method="POST">
            <div class="row">
              <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan Konfirmasi Password">
              </div>
            </div>
            <hr>
            <div class="row mt-4">
              <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php require_once 'footer.php' ?>
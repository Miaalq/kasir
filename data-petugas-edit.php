<?php require_once 'header.php' ?>
<?php require 'proses-edit-petugas.php';
$id_user = $_GET['id'];
$sql = "SELECT * FROM user WHERE id_user = '$id_user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Edit Data Petugas</h1>
      <a href="data-petugas.php" class="btn btn-info mb-3">Kembali</a>
      <div class="card mb-4">
        <div class="card-body">
          <form action="" method="POST">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id_user" value="<?php echo $row['id_user'] ?>">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="<?php echo $row['username'] ?>">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                <i style="color:red">Kosongkan jika tidak ingin mengubah password</i>
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
                <button type="submit" class="btn btn-primary">Simpan Edit Data</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php require_once 'footer.php' ?>
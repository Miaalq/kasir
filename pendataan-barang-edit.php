<?php require_once 'header.php' ?>
<?php require_once 'proses-edit-barang.php';
$produk_id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Pendataan Barang</h1>
      <div class="card mb-4">
        <div class="card-body">
          <form action="" method="POST">
            <input type="hidden" name="produk_id" value="<?php echo $row['produk_id'] ?>">
            <div class="row">
              <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama_produk" placeholder="Masukkan Nama" required value="<?php echo $row['nama_produk'] ?>">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label for="password" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga" required value="<?php echo $row['harga'] ?>">
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
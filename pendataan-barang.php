<?php
require_once 'header.php';
require_once '../koneksi.php';
?>
<div id="layoutSidenav_content">
  <a style="font-family: comic sans MS;">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Data Produk</h1>
      <a href="pendataan-barang-tambah.php" class="btn btn-primary mb-3">Tambah Data</a>
      <div class="card mb-4">
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Kode Produk</th>
                <th>Harga Produk</th>
                <th>Riwayat</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM produk";
              $result = $conn->query($query); ?>
              <?php
              $no = 1;
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['nama_produk'] ?></td>
                  <td><?php echo $row['kode produk'] ?></td>
                  <td><?php echo rupiah($row['harga']) ?></td>
                  <td>
                    <a href="pendataan-barang-edit.php?id=<?= $row['produk_id'] ?>" class="btn btn-warning btn-sm">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="pendataan-barang.php?id=<?php echo $row['produk_id'] ?>&hapus=1" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php
                $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <?php
  if (!empty($_GET['hapus']) && $_GET['hapus'] == 1) {
    $produk_id = $_GET['id'];

    $query_update = "DELETE FROM produk WHERE produk_id=$produk_id";

    if ($conn->query($query_update) === TRUE) {
      echo '<script>
          alert("Berhasil menghapus data barang");
          window.location.href = "pendataan-barang.php";
        </script>';
      die;
    } else {
      echo "Error: " . $query . "<br>" . $conn->error;
    }
  }
  ?>
  <?php
  $conn->close();
  ?>
  <?php require_once 'footer.php' ?>
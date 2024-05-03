<?php
require_once 'header.php';
require_once '../koneksi.php';
?>
<div id="layoutSidenav_content">
  <a style="font-family: comic sans MS;">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Data Stock Produk</h1>
      <div class="card mb-4 mt-5">
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Harga Jual</th>
                <th>Harga Terakhir Beli</th>
                <th>Stok Tersedia</th>
                <th>Riwayat</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM produk";
              $result = $conn->query($query); ?>
              <?php
              $no = 1;
              while ($row = $result->fetch_assoc()) {
                $query_harga_beli_terakhir = "SELECT pembelian_detail.harga_beli FROM pembelian_detail 
                    JOIN pembelian ON pembelian.pembelian_id = pembelian_detail.pembelian_id
                    WHERE produk_id = {$row['produk_id']} AND status='selesai'
                    ORDER BY tanggal_pembelian DESC LIMIT 1";
                $result_query_harga_beli_terakhir = $conn->query($query_harga_beli_terakhir);
                $pembelian = $result_query_harga_beli_terakhir->fetch_assoc();
              ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['nama_produk'] ?></td>
                  <td><?php echo rupiah($row['harga']) ?></td>
                  <td><?php echo rupiah($pembelian['harga_beli']) ?></td>
                  <td><?php echo $row['stok_tersedia'] ?></td>
                  <td>
                    <a href="data-stock-barang-detail.php?id=<?= $row['produk_id'] ?>" class="btn btn-success btn-xs">
                      <i class="fa fa-list"></i>
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
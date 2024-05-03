<?php require_once 'header.php' ?>
<?php require_once 'query-data-penjualan.php' ?>
<?php
$penjualan_id = $_GET['id'];
$row = data_penjualan($penjualan_id);
?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Detail Penjualan Barang</h1>
      <div class="card mb-4">
        <div class="card-body">
          <form action="" method="POST">
            <input type="hidden" name="penjualan_id" value="<?php echo $row['penjualan_id'] ?>">
            <div class="row">
              <div class="col-md-6">
                <label for="penjualan_id" class="form-label">ID Penjualan</label> <br>
                <strong><?php echo $row['penjualan_id'] ?></strong>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="tanggal_penjualan" class="form-label">Waktu Penjualan</label> <br>
                <strong><?php echo $row['tanggal_penjualan'] ?> <?php echo $row['jam_penjualan'] ?></strong>
              </div>
            </div>

            <h5 class="mt-5 text-center">Daftar Barang</h5>
            <hr>
            <table class="table table-bordered">
              <thead>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </thead>
              <tbody>
                <?php
                $result = data_penjualan_detail($penjualan_id);
                $no = 1;
                $total = 0;
                foreach ($result as $key => $value) {
                  $subtotal = $value['harga'] * $value['jumlah'];
                  $total += $subtotal;
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value['nama_produk'] ?></td>
                    <td><?= rupiah($value['harga']) ?></td>
                    <td><?= $value['jumlah'] ?></td>
                    <td class="text-end"><?= rupiah($subtotal) ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="4" class="text-end"><strong>Total</strong></td>
                  <td class="text-end"><strong><?= rupiah($total) ?></strong></td>
                </tr>
              </tbody>
            </table>
            <hr>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php require_once 'footer.php' ?>
<?php require_once 'header.php' ?>
<?php require_once 'query-data-pembelian.php' ?>
<?php
$pembelian_id = $_GET['id'];
$row = data_pembelian($pembelian_id);
?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Detail Pembelian Barang</h1>
      <div class="card mb-4">
        <div class="card-body">
          <form action="" method="POST">
            <input type="hidden" name="pembelian_id" value="<?php echo $row['pembelian_id'] ?>">
            <div class="row">
              <div class="col-md-6">
                <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label> <br>
                <strong><?php echo $row['tanggal_pembelian'] ?></strong>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label for="nama_supplier" class="form-label">Nama Supplier</label><br>
                <strong><?php echo $row['nama_supplier'] ?></strong>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                <label for="invoice_pembelian" class="form-label">Invoice Pembelian</label><br>
                <strong><?php echo $row['invoice_pembelian'] ?></strong>
              </div>
            </div>
            <h5 class="mt-5 text-center">Daftar Barang</h5>
            <hr>
            <table class="table table-bordered">
              <thead>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </thead>
              <tbody>
                <?php
                $result = data_pembelian_detail($pembelian_id);
                $no = 1;
                $total = 0;
                foreach ($result as $key => $value) {
                  $subtotal = $value['harga_beli'] * $value['jumlah'];
                  $total += $subtotal;
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value['nama_produk'] ?></td>
                    <td><?= rupiah($value['harga_beli']) ?></td>
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
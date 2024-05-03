<?php require_once 'header.php' ?>
<?php require_once 'data-penjualan-proses-tambah.php' ?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Tambah Penjualan Barang</h1>
      <div class="card mb-4">
        <div class="card-body">
          <form action="" method="POST">
            <h5 class="mt-5 text-center">Daftar Barang</h5>
            <hr>
            <div class="row mb-3">
              <div class="col-md-8">
                <label for="produk_id" class="form-label">Barang</label>
                <select id="produk_id" class="form-select">
                  <option value="">Pilih Barang</option>
                  <?php
                  $sql = "SELECT * FROM produk WHERE stok_tersedia > 0 ORDER BY nama_produk ASC";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?= $row['produk_id'] ?>" data-harga="<?php echo $row['harga'] ?>"><?= $row['nama_produk'] ?> | <?= rupiah($row['harga']) ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-2">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" placeholder="Jumlah" id="jumlah">
              </div>
              <div class="col-md-2">
                <br>
                <button style="width: 100%;" type="button" class="btn btn-info mt-2" onclick="tambahBarang()">Tambah / Edit Data</button>
              </div>
            </div>
            <hr>
            <table class="table table-bordered">
              <thead>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th style="width: 8%;">Aksi</th>
              </thead>
              <tbody id="daftar_barang"></tbody>
              <tfoot>
                <tr>
                  <td colspan="4" class="text-end"><strong>Total</strong></td>
                  <td class="text-end"><strong id="total"></strong></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
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
  <?php require_once 'data-penjualan-javascript.php' ?>
  <?php require_once 'footer.php' ?>
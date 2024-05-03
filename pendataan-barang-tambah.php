<?php require_once 'header.php' ?>
<?php require_once 'proses-tambah-barang.php' ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pendataan Barang</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama_produk" placeholder="Masukkan Nama" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga" required>
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
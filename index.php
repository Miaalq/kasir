<?php require_once 'header.php' ?>

<?php
$sql = "SELECT count(produk_id) total FROM produk";
$result = $conn->query($sql);
$total_barang = $result->fetch_assoc()['total'];
?>
<div id="layoutSidenav_content">
    <main>     
        <a style="font-family: comic sans MS;">
        <div class="container-fluid px-4">
            <h1 class="mt-4">HOME</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Welcomeback!!!</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-dark mb-5">
                        <div class="card-body">
                            Jenis Produk
                            <br>
                            <h1 class="mt-"><?php echo $total_barang ?></h1>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" href="pendataan-barang.php">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once 'footer.php' ?>
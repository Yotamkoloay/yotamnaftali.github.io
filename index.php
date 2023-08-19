<?php
require_once 'config/database.php';

?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title></title>
    <!-- Favicon-->
    
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="assets/css/landing-page.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Warong Laikit</a>
            <a class="navbar-brand" href="login.php">| Login</a></li>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-1 mb-2 mb-lg-0">
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="top-products">
        <div class="container">
            <div class="row product" style="margin-top: 10px;">
                <div class="col-lg-12">
                    <h2 class="text-center text1"></h2>
                </div>
                <?php
                $perpage = 20;
                $page = isset($_GET['page']) ? $_GET['page'] : "";

                if (empty($page)) {
                    $num = 0;
                    $page = 1;
                } else {
                    $num = ($page - 1) * $perpage;
                }
                $query = "SELECT a.id_ayam,a.nama_ayam,a.id_kategori,a.id_satuan,a.harga,a.stok,a.keterangan,a.foto,b.id_kategori,b.nama_kategori, c.id_satuan,c.nama_satuan,d.id_profil,e.id_profil,e.telepon FROM ayam a INNER JOIN kategori as b INNER JOIN satuan as c INNER JOIN users as d INNER JOIN profil as e ON a.id_kategori=b.id_kategori AND a.id_satuan=c.id_satuan AND d.id_profil=e.id_profil  group by id_ayam  ASC LIMIT $num, $perpage";
                $result = mysqli_query($mysqli, $query);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="col-md-3 col-xs-6 product-left">
                        <div class="p-one">
                            <a href="#">
                                <img src="assets/img/ayam/<?php echo $data['foto']; ?>" />
                            </a>

                            <h4><?php echo $data['nama_ayam']; ?></h4>
                            <p><?php echo $data['stok']; ?><?php echo $data['nama_satuan']; ?></p>
                            <?php
                            if ($data['harga'] == "0") {
                                echo '
							<div class="">
								<button type="button" class="btn btn-danger">
									<span>Rp Tidak Ada' . number_format($data['harga'], 0, ".", ".") . '  </span>
								</button>
							</div>
							';
                            } else {
                                echo '
							<div class="">
                            <button type="button" class="btn btn-success">
									<i>Rp ' . number_format($data['harga'], 0, ".", ".") . ' / ' . ($data['nama_satuan']) . '  </i>
								</button>
							</div>
							';
                            }
                            ?>
                            <br>
                            <h5><?php echo $data['keterangan']; ?></h5>
                            <a href="https://wa.me/62<?php echo $data['telepon']; ?>?text=Asu"> <i class='fab fa-whatsapp fa-3x'></i></a><br>

                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="clearfix"></div>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
                <script src="assets/js/scripts.js"></script>
</body>

</html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Warong_laikit</title>
    <!-- Favicon-->
    
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/landing-page.css" rel="stylesheet" type="text/css" />
    
  <!-- Bootstrap 3.3.2 -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <!-- Datepicker -->
  <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
  <!-- Chosen Select -->
  <link rel="stylesheet" type="text/css" href="assets/plugins/chosen/css/chosen.min.css" />
  <!-- Theme style -->
  <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link href="assets/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />
  <!-- Date Picker -->
  <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
   
    <!-- Page content-->
    <div class="top-products">
        <div class="">
            <div class="row product">
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
							</div> <br>
                            <div class="">
                            <button type="button" class="btn btn-success">
									<i>Tawar </i>
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
        
</body>

</html>
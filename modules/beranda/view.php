<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-home icon-title"></i> Beranda
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=home"><i class="fa fa-home"></i> Beranda</a></li>
  </ol>
</section>


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12 col-xs-12">
      <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p style="font-size:15px">
          <i class="icon fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama']; ?></strong> Anda Masuk Sebagai <strong><?php echo $_SESSION['hak_akses']; ?></strong>.
        </p>
      </div>
    </div>
  </div>
  
  
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <?php
    if ($_SESSION['hak_akses'] == 'Pembeli') { ?>
      <body>
   
    <!-- Page content-->
    <div class="top-products">
        <div class="">
            <div class="row product" style="margin-left: 2%;">
                <div class="col-lg-12">
                    <h2 class="text-center text1"></h2>
                </div>
                <?php
                $perpage = 16;
                $page = isset($_GET['page']) ? $_GET['page'] : "";

                if (empty($page)) {
                    $num = 0;
                    $page = 1;
                } else {
                    $num = ($page - 1) * $perpage;
                }
                $query = "SELECT a.id_ayam,a.id_kategori,a.id_satuan,a.harga,a.stok,a.keterangan,a.foto,a.created_user,b.id_kategori,b.nama_kategori, c.id_satuan,c.nama_satuan,d.id_user,d.id_profil,e.id_profil,e.telepon FROM ayam a INNER JOIN kategori as b INNER JOIN satuan as c INNER JOIN users as d INNER JOIN profil as e ON a.id_kategori=b.id_kategori AND a.id_satuan=c.id_satuan AND a.created_user=d.id_user AND e.id_profil=d.id_profil group by a.id_ayam order by b.nama_kategori ASC LIMIT $num, $perpage";
                $result = mysqli_query($mysqli, $query);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="col-md-3 col-xs-6 center" >
                        <div class="p-one" style=" 
  top: 50%;
  left: 50%;
" >
                            <a href="assets/img/ayam/<?php echo $data['foto']; ?>" >
                                <img width="65%" src="assets/img/ayam/<?php echo $data['foto']; ?>" />
                            </a>

                            <h4><?php echo $data['nama_kategori']; ?></h4>
                            <p><?php echo $data['stok']; ?> <?php echo $data['nama_satuan']; ?></p>
                            <?php
                            if ($data['harga'] == "0") {
                                echo '
							<div class="col-md-3 col-xs-6 ">
								<button type="button" class="btn btn-danger">
									<span>Rp Tidak Ada' . number_format($data['harga'], 0, ".", ".") . '  </span>
								</button>
							</div>
							';
                            } else {
                                echo '
							<div class="">
                            <button type="button" class="btn btn-warning">
									<i>Rp ' . number_format($data['harga'], 0, ".", ".") . ' / ' . ($data['nama_satuan']) . '  </i>
								</button>
							</div> 
              ';}   
                            ?>
                      <div>
              <a href="https://wa.me/62<?php echo $data['telepon']; ?>?text=Hallo Kak, Cek Ayam <?php echo $data['nama_kategori']; ?>"><button class="button btn-success">Hubungi</button></a><a href="?module=form_ayam_keluar&form=add&ayam&id=<?php echo $data['id_ayam']; ?>&idp=<?php echo $data['created_user']; ?>"><button class="button btn-primary">Tawar</button></a> </div>
							

                        </div>
                    </div>
                <?php
                }
                ?>
        
</body>
  </div>




<?php
    }
    ?>


  </div>
</section><!-- /.content -->
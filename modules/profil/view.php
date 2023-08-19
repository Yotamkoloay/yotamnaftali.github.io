<?php
if (isset($_SESSION['id_user'])) {
  // fungsi query untuk menampilkan data dari tabel user
  $query = mysqli_query($mysqli, "SELECT a.nama,a.jenis_kelamin,a.id_profil, a.tempat, a.telepon,a.foto, b.id_user FROM profil as a inner join users as b ON b.id_profil=a.id_profil WHERE b.id_user='$_SESSION[id_user]'")
    or die('Ada kesalahan pada query tampil data user : ' . mysqli_error($mysqli));
  $data  = mysqli_fetch_assoc($query);
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-user icon-title"></i> Profil User
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=home"><i class="fa fa-home"></i> Beranda</a></li>
    <li class="active">Profil User</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <?php
      // fungsi untuk menampilkan pesan
      // jika alert = "" (kosong)
      // tampilkan pesan "" (kosong)
      if (empty($_GET['alert'])) {
        echo "";
      }
      // jika alert = 1
      // tampilkan pesan Sukses "Profil user berhasil diubah"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Profil user berhasil diubah.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload sudah benar"
      elseif ($_GET['alert'] == 2) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload sudah benar.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Upload Gagal "Pastikan ukuran foto tidak lebih dari 1MB"
      elseif ($_GET['alert'] == 3) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan ukuran foto tidak lebih dari 1MB.
            </div>";
      }
      // jika alert = 4
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
      elseif ($_GET['alert'] == 4) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <!-- form start -->
        <form role="form" class="form-horizontal" method="POST" action="?module=form_profil" enctype="multipart/form-data">
          <div class="box-body">

            <input type="hidden" name="id_profil" value="<?php echo $data['id_profil']; ?>">

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <?php
              if ($data['foto'] == "") { ?>
                <img style="border:1px solid #eaeaea;border-radius:50px;" src="assets/img/user/user-default.png" width="100">
              <?php
              } else { ?>
                <img style="border:1px solid #eaeaea;border-radius:50px;" src="assets/img/user/<?php echo $data['foto']; ?>" width="100">
              <?php
              }
              ?>

            </div>


            <div class="form-group">
              <label class="col-sm-2 control-label">Nama</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['nama']; ?></label>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Kelamin</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['jenis_kelamin']; ?></label>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">alamat</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['tempat']; ?></label>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">telepon</label>
              <label style="text-align:left" class="col-sm-8 control-label">: <?php echo $data['telepon']; ?></label>
            </div>

        

          </div><!-- /.box body -->

          <div class="box-footer">
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-submit" name="ubah" value="Ubah">
              </div>
            </div>
          </div><!-- /.box footer -->
        </form>
      </div><!-- /.box -->
    </div>
    <!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content
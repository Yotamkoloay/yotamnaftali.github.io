<?php
if (isset($_SESSION['id_user'])) {
  // fungsi query untuk menampilkan data dari tabel user
  $query = mysqli_query($mysqli, "SELECT a.nama,a.jenis_kelamin,a.id_profil, a.tempat, a.telepon, a.foto, b.id_user FROM profil as a inner join users as b ON b.id_profil=a.id_profil WHERE b.id_user='$_SESSION[id_user]'")
    or die('Ada kesalahan pada query tampil data user : ' . mysqli_error($mysqli));
  $data  = mysqli_fetch_assoc($query);
  $jenis_kelamin   = $data['jenis_kelamin'];
}
?>
<!-- tampilkan form edit data -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-edit icon-title"></i> Ubah Profil User
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
    <li><a href="?module=profil"> Profil User </a></li>
    <li class="active"> Ubah </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" class="form-horizontal" method="POST" action="modules/profil/proses.php?act=update" enctype="multipart/form-data">
          <div class="box-body">

            <input type="hidden" name="id_profil" value="<?php echo $data['id_profil']; ?>">

          
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php echo $data['nama']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="jenis_kelamin" autocomplete="off" value="<?php echo $data['jenis_kelamin']; ?>" required>
              </div>
            </div>
              <div class="form-group">
              <label class="col-sm-2 control-label">Alamat </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="tempat" autocomplete="off" value="<?php echo $data['tempat']; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Telepon</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="telepon" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['telepon']; ?>">
              </div>
            </div>


     
            <div class="form-group">
              <label class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-5">
                <input type="file" name="foto">
                <br />
                <?php
                if ($data['foto'] == "") { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="assets/img/tanaman/tanaman-default.png" width="128">
                <?php
                } else { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="assets/img/tanaman/tanaman-default.png" width="128">
                <?php
                }
                ?>
              </div>
            </div>
                 </div><!-- /.box body -->

          <div class="box-footer">
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                <a href="?module=profil" class="btn btn-default btn-reset">Batal</a>
              </div>
            </div>
          </div><!-- /.box footer -->
        </form>
      </div><!-- /.box -->
    </div>
    <!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content -->
<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') {

  if (isset($_GET['id'])) {
    // fungsi query untuk menampilkan data dari tabel user
    $query = mysqli_query($mysqli, "SELECT * FROM users ")
      or die('Ada kesalahan pada query tampil data user : ' . mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);
  } else {

  }
?>
  <!-- tampilkan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input User
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=4dm1n"> User </a></li>
      <li class="active"> Input </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/user/proses_admin.php?act=insert" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="username" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" name="password" autocomplete="off" required>
                </div>
              </div>


                <div class="form-group" >
                <label class="col-sm-2 control-label">Hak Akses</label>
                <div class="col-sm-5">
                  <select class="form-control" name="hak_akses" >
                    <option value="Penjual">Penjual</option>
                    <option value="Pembeli">Pembeli</option>
                  </select>
                </div>
              </div>

              
              <div class="form-group">
                <label class="col-sm-2 control-label">Profil</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="profil" data-placeholder="-- Pilih Profil --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_profil = mysqli_query($mysqli, "SELECT * FROM profil ORDER BY id_profil ASC")
                      or die('Ada kesalahan pada query tampil profil: ' . mysqli_error($mysqli));
                    while ($data_profil = mysqli_fetch_assoc($query_profil)) {
                      echo "<option value=\"$data_profil[id_profil]\"> $data_profil[nama] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=4dm1n" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div>
      <!--/.col -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
<?php
}

// jika form edit data yang dipilih
elseif ($_GET['form'] == 'edit') {
  if (isset($_GET['id'])) {
    // fungsi query untuk menampilkan data dari tabel user
    $query = mysqli_query($mysqli, "SELECT a.username,a.password,a.hak_akses,a.id_profil,b.id_profil, b.nama, b.jenis_kelamin, b.tempat, b.telepon, b.luas, b.foto FROM users as a INNER JOIN profil as b ON a.id_profil=b.id_profil  WHERE id_user='$_GET[id]'")
      or die('Ada kesalahan pada query tampil data user : ' . mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);
  }
?>
  <!-- tampilkan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Data User
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda</a></li>
      <li><a href="?module=4dm1n"> User </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/user/proses_admin.php?act=update" enctype="multipart/form-data">
            <div class="box-body">

              <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

              <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="username" autocomplete="off" value="<?php echo $data['username']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Kosongkan password jika tidak diubah">
                </div>
              </div>



              <div class="form-group" >
                <label class="col-sm-2 control-label">Hak Akses</label>
                <div class="col-sm-5">
                  <select class="form-control" name="hak_akses" >
                    <option value="<?php echo $data['hak_akses']; ?>"><?php echo $data['hak_akses']; ?></option>
                    <option value="Penjual">Penjual</option>
                    <option value="Pembeli">Pembeli</option>
                  </select>
                </div>
              </div>

              

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=4dm1n" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div>
      <!--/.col -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>
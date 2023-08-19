<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Profil User
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=m-profil"> Profil </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/m-profil/proses.php?act=insert" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama User</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Telepon</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="telepon" autocomplete="off" required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=m-profil" class="btn btn-default btn-reset">Batal</a>
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
// isset : cek data ada / tidak
elseif ($_GET['form'] == 'edit') {
  if (isset($_GET['id'])) {
    // fungsi query untuk menampilkan data dari tabel profil
    $query = mysqli_query($mysqli, "SELECT * FROM profil WHERE id_profil='$_GET[id]'")
      or die('Ada kesalahan pada query tampil Data Profil User : ' . mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);
  }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Data Profil
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=m-profil"> Profil </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/m-profil/proses.php?act=update" method="POST">
            <div class="box-body">

              <input type="hidden" name="id_profil" value="<?php echo $data['id_profil']; ?>">

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama User</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php echo $data['nama']; ?>" required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=m-profil" class="btn btn-default btn-reset">Batal</a>
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
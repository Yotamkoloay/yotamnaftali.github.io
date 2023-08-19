<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Tangkapan
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=tangkapan"> Tangkapan </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/tangkapan/proses.php?act=insert" method="POST">
            <div class="box-body">
              <?php
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_tangkapan,6) as kode FROM tangkapan
                                                ORDER BY id_tangkapan DESC LIMIT 1")
                or die('Ada kesalahan pada query tampil id_tangkapan : ' . mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                // mengambil data id_tangkapan
                $data_id = mysqli_fetch_assoc($query_id);
                $kode    = $data_id['kode'] + 1;
              } else {
                $kode = 1;
              }

              // buat id_tangkapan
              $buat_id   = str_pad($kode, 6, "0", STR_PAD_LEFT);
              $id_tangkapan = "T$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">ID Tangkapan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_tangkapan" value="<?php echo $id_tangkapan; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Tangkapan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_tangkapan" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Tangkapan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="jenis" data-placeholder="-- Pilih Jenis --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_jenis = mysqli_query($mysqli, "SELECT * FROM jenis_tangkapan ORDER BY id_jenis ASC")
                      or die('Ada kesalahan pada query tampil jenis: ' . mysqli_error($mysqli));
                    while ($data_jenis = mysqli_fetch_assoc($query_jenis)) {
                      echo "<option value=\"$data_jenis[id_jenis]\"> $data_jenis[nama_jenis] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="satuan" data-placeholder="-- Pilih Satuan --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_satuan = mysqli_query($mysqli, "SELECT * FROM satuan ORDER BY id_satuan ASC")
                      or die('Ada kesalahan pada query tampil satuan: ' . mysqli_error($mysqli));
                    while ($data_satuan = mysqli_fetch_assoc($query_satuan)) {
                      echo "<option value=\"$data_satuan[id_satuan]\"> $data_satuan[nama_satuan] </option>";
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
                  <a href="?module=tangkapan" class="btn btn-default btn-reset">Batal</a>
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
    // fungsi query untuk menampilkan data dari tabel tangkapan
    $query = mysqli_query($mysqli, "SELECT a.id_tangkapan,a.nama_tangkapan,a.id_satuan,a.id_jenis,b.id_jenis,b.nama_jenis,c.id_satuan,c.nama_satuan 
                                      FROM tangkapan as a INNER JOIN jenis_tangkapan as b INNER JOIN satuan as c
                                      ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan WHERE id_tangkapan='$_GET[id]'")
      or die('Ada kesalahan pada query tampil Data Tangkapan : ' . mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);
  }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Tangkapan
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=tangkapan"> Tangkapan </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/tangkapan/proses.php?act=update" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">ID Tangkapan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_tangkapan" value="<?php echo $data['id_tangkapan']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Tangkapan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_tangkapan" autocomplete="off" value="<?php echo $data['nama_tangkapan']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Tangkapan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="jenis" data-placeholder="-- Pilih Jenis --" autocomplete="off" required>
                    <option value="<?php echo $data['id_jenis']; ?>"><?php echo $data['nama_jenis']; ?></option>
                    <?php
                    $query_jenis = mysqli_query($mysqli, "SELECT * FROM jenis_tangkapan ORDER BY id_jenis ASC")
                      or die('Ada kesalahan pada query tampil jenis: ' . mysqli_error($mysqli));
                    while ($data_jenis = mysqli_fetch_assoc($query_jenis)) {
                      echo "<option value=\"$data_jenis[id_jenis]\"> $data_jenis[nama_jenis] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="satuan" data-placeholder="-- Pilih Satuan --" autocomplete="off" required>
                    <option value="<?php echo $data['id_satuan']; ?>"><?php echo $data['nama_satuan']; ?></option>
                    <?php
                    $query_satuan = mysqli_query($mysqli, "SELECT * FROM satuan ORDER BY id_satuan ASC")
                      or die('Ada kesalahan pada query tampil satuan: ' . mysqli_error($mysqli));
                    while ($data_satuan = mysqli_fetch_assoc($query_satuan)) {
                      echo "<option value=\"$data_satuan[id_satuan]\"> $data_satuan[nama_satuan] </option>";
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
                  <a href="?module=tangkapan" class="btn btn-default btn-reset">Batal</a>
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
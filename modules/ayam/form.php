<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') {
  $query = mysqli_query($mysqli, "SELECT * FROM ayam")
    or die('Ada kesalahan pada query tampil data user : ' . mysqli_error($mysqli));
  $data  = mysqli_fetch_assoc($query);
?>

  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      <i class="fa fa-edit icon-title"></i> Input Data Ayam
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=ayam"> Ayam </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/ayam/proses.php?act=insert" method="POST" enctype="multipart/form-data">
            <div class="box-body">
              <?php
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_ayam,6) as kode FROM ayam
                                                ORDER BY id_ayam DESC LIMIT 1")
                or die('Ada kesalahan pada query tampil id_ayam : ' . mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                // mengambil data id_ayam
                $data_id = mysqli_fetch_assoc($query_id);
                $kode    = $data_id['kode'] + 1;
              } else {
                $kode = 1;
              }

              // buat id_ayam
              $buat_id   = str_pad($kode, 6, "0", STR_PAD_LEFT);
              $id_ayam = "A$buat_id";
              ?>

              <div class="form-group">

                <div class="col-sm-5">
                  <input type="hidden" class="form-control" name="id_ayam" value="<?php echo $id_ayam; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="kategori" data-placeholder="-- Pilih Kategori --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_kategori = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY id_kategori ASC")
                      or die('Ada kesalahan pada query tampil kategori: ' . mysqli_error($mysqli));
                    while ($data_kategori = mysqli_fetch_assoc($query_kategori)) {
                      echo "<option value=\"$data_kategori[id_kategori]\"> $data_kategori[nama_kategori] </option>";
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

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga" name="harga" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>


            <div class="form-group">
              <label class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-5">
                <input type="file" name="foto" required>
                <br />
                <?php
                if ($data['foto'] == "") { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="assets/img/ayam/ayam-default.png" width="128">
                <?php
                } else { ?>
                              <img style="border:1px solid #eaeaea;border-radius:5px;" src="assets/img/ayam/<?php echo $data['foto']; ?>" width="128">

                <?php
                }
                ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="keterangan" autocomplete="off" >
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=ayam" class="btn btn-default btn-reset">Batal</a>
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
    // fungsi query untuk menampilkan data dari tabel ayam
    $query = mysqli_query($mysqli, "SELECT a.id_kategori,a.id_ayam,  a.harga, a.foto, a.keterangan,  b.id_kategori, b.nama_kategori, c.id_satuan, c.nama_satuan
                 FROM ayam as a inner join kategori as b inner join satuan as c
                                            on a.id_kategori=b.id_kategori and a.id_satuan=c.id_satuan WHERE a.id_ayam='$_GET[id]' Group BY a.id_ayam asc")
      or die('Ada kesalahan pada query tampil Data Penilaian: ' . mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);
    $foto     = mysqli_real_escape_string($mysqli, trim($_GET['foto']));
  }
?>
  <!-- tampilan form  editdata -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Ayam
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=ayam"> Ayam </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/ayam/proses.php?act=update" enctype="multipart/form-data" method="POST">
            <div class="box-body">

              <div class="form-group">

                <div class="col-sm-5">
                  <input type="hidden" class="form-control" name="id_ayam" value="<?php echo $data['id_ayam']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="kategori" data-placeholder="-- Pilih Kategori --" autocomplete="off" required>
                    <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                    <?php
                    $query_kategori = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY id_kategori ASC")
                      or die('Ada kesalahan pada query tampil kategori: ' . mysqli_error($mysqli));
                    while ($data_kategori = mysqli_fetch_assoc($query_kategori)) {
                      echo "<option value=\"$data_kategori[id_kategori]\"> $data_kategori[nama_kategori] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

           


              <div class="form-group">
                <label class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="satuan" data-placeholder="-- Pilih Satuan --" autocomplete="off" required>
                    <option value="<?php echo $data['id_satuan'];?>"><?php echo $data['nama_satuan'];?></option>
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

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="harga" name="harga" autocomplete="off" value="<?php echo $data['harga']; ?> / <?php echo $data['nama_satuan']; ?>" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="keterangan" autocomplete="off" value="<?php echo $data['keterangan']; ?>" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-5">
                <input type="file" name="foto">
                <br />
                <?php
               if ($data['foto'] == "") { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="assets/img/ayam/ayam-default.png" width="128">
                <?php
                } else { ?>
            c      <img style="border:1px solid #eaeaea;border-radius:5px;" src="assets/img/ayam/<?php echo $data['foto']; ?>" width="128">
                <?php
                }
                ?>
              </div>
            </div>


            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=ayam" class="btn btn-default btn-reset">Batal</a>
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
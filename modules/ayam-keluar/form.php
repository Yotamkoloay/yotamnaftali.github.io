<script type="text/javascript">
  function tampil_ayam(input){
    var num = input.value;

    $.post("modules/ayam-keluar/ayam.php", {
      dataidayam: num,
    }, function(response) {      
      $('#stok').html(response)

      document.getElementById('jumlah_keluar').focus();
    });
  }

  function cek_jumlah_keluar(input) {
    jml = document.formAyamKeluar.jumlah_keluar.value;
    var jumlah = eval(jml);
    if(jumlah < 1){
      alert('Jumlah Keluar Tidak Boleh Nol !!');
      input.value = input.value.substring(0,input.value.length-1);
    }
  }

  function cek_stok(input) {
    st = document.formAyamKeluar.stok.value;
    jm = document.formAyamKeluar.jumlah_keluar.value;
    var num = input.value;
    var stk = eval(st);
    var jml = eval(jm);
      if(stk < jml){
        alert('Stok Tidak Memenuhi, Kurangi Jumlah Ayam Keluar');
        input.value = input.value.substring(0,input.value.length-1);
      }
  }

  function hitung_sisa_stok() {
    bil1 = document.formAyamKeluar.stok.value;
    bil2 = document.formAyamKeluar.jumlah_keluar.value;

    if (bil2 == "") {
      var hasil = "";
    }
    else {
      var hasil = eval(bil1) - eval(bil2);
    }

    document.formAyamKeluar.total_stok.value = (hasil);
  }
</script>

<?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { 
  if (isset($_GET['id'])) { 
    // fungsi query untuk menampilkan data dari tabel ayam
    $query = mysqli_query($mysqli, "SELECT a.id_ayam,a.id_satuan,a.id_kategori,a.stok,b.id_satuan,b.nama_satuan,c.id_kategori,c.nama_kategori
    FROM ayam as a INNER JOIN satuan as b INNER JOIN kategori as c
    ON a.id_satuan=b.id_satuan AND a.id_kategori=c.id_kategori WHERE a.id_ayam='$_GET[id]'") 
    or die('Ada kesalahan pada query tampil Data ayam : '.mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);

    $id_ayam   = $data['id_ayam'];
    $stok        = $data['stok'];
    $nama_satuan = $data['nama_satuan'];
    $kategori = $data['nama_kategori'];

  } else {
    $id_ayam   = "";
    $stok        = "";
    $nama_satuan = "";
    $kategori = "";
  }
?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Form Pembelian
    </h1>
    <ol class="breadcrumb"><br>
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=ayam_keluar"> Permintaan </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/ayam-keluar/proses.php?act=insert" method="POST" name="formAyamKeluar">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_ayam_keluar,7) as kode FROM ayam_keluar
                                                ORDER BY id_ayam_keluar DESC LIMIT 1")
                                                or die('Ada kesalahan pada query tampil id_ayam_keluar : '.mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                  // mengambil data id_ayam_keluar
                  $data_id = mysqli_fetch_assoc($query_id);
                  $kode    = $data_id['kode']+1;
              } else {
                  $kode = 1;
              }

              // buat id_ayam_keluar
              $tahun           = date("Y");
              $buat_id         = str_pad($kode, 7, "0", STR_PAD_LEFT);
              $id_ayam_keluar = "TP-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">ID Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_ayam_keluar" value="<?php echo $id_ayam_keluar; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" readonly required>
                </div>
              </div>
             
              <div class="form-group">
                <label class="col-sm-2 control-label">Ayam</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="id_ayam" data-placeholder="-- Pilih Ayam --" onchange="tampil_ayam(this)" autocomplete="off" required>
                    <option value="<?php echo $id_ayam; ?>"><?php echo $kategori; ?></option>
                    <?php
                      $query_ayam = mysqli_query($mysqli, "SELECT a.id_ayam,a.id_kategori,b.id_kategori,b.nama_kategori FROM ayam as a INNER JOIN kategori as b ON a.id_kategori = b.id_kategori ORDER BY id_ayam ASC")
                                                            or die('Ada kesalahan pada query tampil ayam: '.mysqli_error($mysqli));
                      while ($data_ayam = mysqli_fetch_assoc($query_ayam)) {
                        echo"<option value=\"$data_ayam[id_ayam]\"> $data_ayam[nama_kategori] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <span id='stok'>
              <div class="form-group">
                <label class="col-sm-2 control-label">Stok</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>" readonly required>
                </div>
              </div>
              </span>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Keluar</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="cek_jumlah_keluar(this)&cek_stok(this)&hitung_sisa_stok(this)" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tersisa</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Satuan</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-addon" >Rp.</span>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Tawarkan Harga Anda" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                  </div>
                </div>
              </div>

              
            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=ayam_keluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->

  <?php  
}
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='adds') { 
  if (isset($_GET['id'])) { 
    // fungsi query untuk menampilkan data dari tabel barang
     $query = mysqli_query($mysqli, "SELECT a.id_barang,a.nama_barang,a.id_satuan,a.stok,b.id_satuan,b.nama_satuan,d.nama_tim,d.id_tim
                                    FROM is_barang as a INNER JOIN is_satuan as b INNER JOIN is_barang_keluar as c INNER JOIN is_tim as d
                                    ON a.id_satuan=b.id_satuan WHERE a.id_barang='$_GET[id]' AND d.nama_tim='$_GET[tim]'") 
                                    or die('Ada kesalahan pada query tampil Data Barang : '.mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);

    $id_barang   = $data['id_barang'];
    $id_tim   = $data['id_tim'];
    $nama_barang = $data['id_barang']." | ".$data['nama_barang'];
    $nama_tim = $data['id_tim']." | ".$data['nama_tim'];
    $stok        = $data['stok'];
    $nama_satuan = $data['nama_satuan'];
    $tim         = $data['nama_tim'];

  } else {
    $id_barang   = "";
    $nama_barang = "";
    $nama_tim = "";
    $stok        = "";
    $nama_satuan = "";
  }
?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Data Permintaan
    </h1>
    <ol class="breadcrumb"><br>
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barang_keluar"> Permintaan </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barang-keluar/proses.php?act=insert" method="POST" name="formBarangKeluar">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_barang_keluar,7) as kode FROM is_barang_keluar
                                                ORDER BY id_barang_keluar DESC LIMIT 1")
                                                or die('Ada kesalahan pada query tampil id_barang_keluar : '.mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                  // mengambil data id_barang_keluar
                  $data_id = mysqli_fetch_assoc($query_id);
                  $kode    = $data_id['kode']+1;
              } else {
                  $kode = 1;
              }

              // buat id_barang_keluar
              $tahun           = date("Y");
              $buat_id         = str_pad($kode, 7, "0", STR_PAD_LEFT);
              $id_barang_keluar = "TP-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">ID Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_barang_keluar" value="<?php echo $id_barang_keluar; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" readonly required>
                </div>
              </div>

             

              <div class="form-group">
                <label class="col-sm-2 control-label">Barang</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="id_barang" data-placeholder="-- Pilih Barang --" onchange="tampil_barang(this)" autocomplete="off" required>
                    <option value="<?php echo $id_barang; ?>"><?php echo $nama_barang; ?></option>
                    <?php
                      $query_barang = mysqli_query($mysqli, "SELECT id_barang, nama_barang FROM is_barang ORDER BY id_barang ASC")
                                                            or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                      while ($data_barang = mysqli_fetch_assoc($query_barang)) {
                        echo"<option value=\"$data_barang[id_barang]\"> $data_barang[nama_barang] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <span id='stok'>
              <div class="form-group">
                <label class="col-sm-2 control-label">Stok</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>" readonly required>
                </div>
              </div>
              </span>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Keluar</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="cek_jumlah_keluar(this)&cek_stok(this)&hitung_sisa_stok(this)" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tersisa</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=barang_keluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->

  <?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel barang
      $query = mysqli_query($mysqli, "SELECT a.id_barang_keluar,a.tanggal_keluar,a.id_barang,a.jumlah_keluar,a.status,b.id_barang,b.nama_barang,b.id_satuan,b.stok,c.id_satuan,c.nama_satuan,d.username,d.id_user,e.nama_tim
                                            FROM is_barang_keluar as a INNER JOIN is_barang as b INNER JOIN is_satuan as c INNER JOIN is_users as d INNER JOIN is_tim as e
                                            ON a.id_barang=b.id_barang AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user
                                            WHERE a.id_barang_keluar='$_GET[id]'")
                                      or die('Ada kesalahan pada query tampil Data Barang : '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Barang
    </h1>
    <ol class="breadcrumb"><br>
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barang"> Barang </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barang-keluar/proses.php?act=update" method="POST">
            <div class="box-body">
              
            <div class="form-group">
                <label class="col-sm-2 control-label">ID Permintaan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_barang_keluar" value="<?php echo $data['id_barang_keluar']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Pengguna</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Barang</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_barang" autocomplete="off" value="<?php echo $data['nama_barang']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">TIM</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_tim" autocomplete="off" value="<?php echo $data['nama_tim']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="jumlah_keluar" autocomplete="off" value="<?php echo $data['jumlah_keluar']; ?>" required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=barang_keluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
  <?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='cetak') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel barang
      $query = mysqli_query($mysqli, "SELECT a.id_barang_keluar,a.tanggal_keluar,a.id_barang,a.jumlah_keluar,a.status,b.id_barang,b.nama_barang,b.id_satuan,b.stok,c.id_satuan,c.nama_satuan,d.username,d.id_user,e.nama_tim
                                            FROM is_barang_keluar as a INNER JOIN is_barang as b INNER JOIN is_satuan as c INNER JOIN is_users as d INNER JOIN is_tim as e 
                                            ON a.id_barang=b.id_barang AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user
                                            WHERE a.id_barang_keluar='$_GET[id]'")
                                      or die('Ada kesalahan pada query tampil Data Barang : '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Permintaan Barang
    </h1>
    <br>
    <ol class="breadcrumb"><br>
      <hr>
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barang"> Barang </a></li>
      <li class="active"> Permintaan </li>
    </ol>
  </section>

  <br>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barang-keluar/proses.php?act=print" method="POST">
            <div class="box-body">
              
            <div class="form-group">
                <label class="col-sm-2 control-label">ID Permintaan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_barang_keluar" value="<?php echo $data['id_barang_keluar']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Pengguna</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Barang</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_barang" autocomplete="off" value="<?php echo $data['nama_barang']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">TIM</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_tim" autocomplete="off" value="<?php echo $data['nama_tim']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">  
                  <input type="text" class="form-control" name="jumlah_keluar" autocomplete="off" value="<?php echo $data['jumlah_keluar']; ?>" readonly required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" method="GET" target="_blank" class="btn btn-primary btn-submit" name="simpan" value="Cetak">
                  <a href="?module=barang_keluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
  
  <?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
      // fungsi query untuk menampilkan data dari tabel barang
      $query = mysqli_query($mysqli, "SELECT a.id_barang_keluar,a.tanggal_keluar,a.id_barang,a.jumlah_keluar,a.status,b.id_barang,b.nama_barang,b.id_satuan,b.stok,c.id_satuan,c.nama_satuan,d.username,d.id_user,e.nama_tim
                                            FROM is_barang_keluar as a INNER JOIN is_barang as b INNER JOIN is_satuan as c INNER JOIN is_users as d INNER JOIN is_tim as e
                                            ON a.id_barang=b.id_barang AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user
                                            WHERE a.id_barang_keluar='$_GET[id]'")
                                      or die('Ada kesalahan pada query tampil Data Barang : '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Ubah Barang
    </h1>
    <br>
    <ol class="breadcrumb"><br>
      <hr>
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barang"> Barang </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>
  <br>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barang-keluar/proses.php?act=update" method="POST">
            <div class="box-body">
              
            <div class="form-group">
                <label class="col-sm-2 control-label">ID Permintaan</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_barang_keluar" value="<?php echo $data['id_barang_keluar']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Pengguna</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Barang</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_barang" autocomplete="off" value="<?php echo $data['nama_barang']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">TIM</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_tim" autocomplete="off" value="<?php echo $data['nama_tim']; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="jumlah_keluar" autocomplete="off" value="<?php echo $data['jumlah_keluar']; ?>" required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=barang_keluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
  
<?php
}
?>
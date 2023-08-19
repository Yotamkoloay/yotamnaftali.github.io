<script type="text/javascript">
  function tampil_ayam(input){
    var num = input.value;

    $.post("modules/ayam-masuk/ayam.php", {
      dataidayam: num,
    }, function(response) {      
      $('#stok').html(response)

      document.getElementById('jumlah_masuk').focus();
    });
  }

  function cek_jumlah_masuk(input) {
    jml = document.formAyamMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if(jumlah < 1){
      alert('Jumlah Masuk Tidak Boleh Nol !!');
      input.value = input.value.substring(0,input.value.length-1);
    }
  }

  function hitung_total_stok() {
    bil1 = document.formAyamMasuk.stok.value;
    bil2 = document.formAyamMasuk.jumlah_masuk.value;

    if (bil2 == "") {
      var hasil = "";
    }
    else {
      var hasil = eval(bil1) + eval(bil2);
    }

    document.formAyamMasuk.total_stok.value = (hasil);
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
    $kategori   = $data['nama_kategori'];
    $stok        = $data['stok'];
    $nama_satuan = $data['nama_satuan'];

  } else {
    $id_ayam   = "";
    $nama_ayam = "";
    $stok        = "";
    $nama_satuan = "";
  }
?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Data Ayam Masuk
    </h1>
    <br>
    <ol class="breadcrumb">
      <hr>
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=ayam_masuk"> Ayam Masuk </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>
  <br>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/ayam-masuk/proses.php?act=insert" method="POST" name="formAyamMasuk">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_ayam_masuk,7) as kode FROM ayam_masuk
                                                ORDER BY id_ayam_masuk DESC LIMIT 1")
                                                or die('Ada kesalahan pada query tampil id_ayam_masuk : '.mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                  // mengambil data id_ayam_masuk
                  $data_id = mysqli_fetch_assoc($query_id);
                  $kode    = $data_id['kode']+1;
              } else {
                  $kode = 1;
              }

              // buat id_ayam_masuk
              $tahun           = date("Y");
              $buat_id         = str_pad($kode, 7, "0", STR_PAD_LEFT);
              $id_ayam_masuk = "TM-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">ID Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_ayam_masuk" value="<?php echo $id_ayam_masuk; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_masuk" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <label class="col-sm-2 control-label">Ayam</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="id_ayam" data-placeholder="-- Pilih Ayam --" onchange="tampil_ayam(this)" autocomplete="off" required>
                    <option value="<?php echo $id_ayam; ?>"></option>
                    <?php
                      $query_ayam = mysqli_query($mysqli, "SELECT a.id_ayam,a.id_kategori,b.id_kategori,b.nama_kategori FROM ayam as a INNER JOIN kategori as b ORDER BY id_ayam ASC")
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
                <label class="col-sm-2 control-label">Jumlah Masuk</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Total Stok</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=ayam_masuk" class="btn btn-default btn-reset">Batal</a>
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
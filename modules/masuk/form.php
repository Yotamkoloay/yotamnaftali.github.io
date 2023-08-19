<script type="text/javascript">
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.watchPosition(showPosition);
    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
      "<br>Longitude: " + position.coords.longitude;
  }

  function tampil_tangkapan(input) {
    var num = input.value;

    $.post("modules/masuk/tangkapan.php", {
      dataidtangkapan: num,
    }, function(response) {
      $('#stok').html(response)

      document.getElementById('jumlah_masuk').focus();
    });
  }

  function cek_jumlah_masuk(input) {
    jml = document.formTangkapanMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
      alert('Jumlah Masuk Tidak Boleh Nol !!');
      input.value = input.value.substring(0, input.value.length - 1);
    }
  }

  function hitung_total_stok() {
    bil1 = document.formTangkapanMasuk.stok.value;
    bil2 = document.formTangkapanMasuk.jumlah_masuk.value;

    if (bil2 == "") {
      var hasil = "";
    } else {
      var hasil = eval(bil1) + eval(bil2);
    }

    document.formTangkapanMasuk.total_stok.value = (hasil);
  }
</script>

<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') {
  if (isset($_GET['id'])) {
    // fungsi query untuk menampilkan data dari tabel Tangkapan
    $query = mysqli_query($mysqli, "SELECT a.id_tangkapan,a.nama_tangkapan,a.id_satuan,a.stok,a.created_user,b.id_satuan,b.nama_satuan,d.id_user 
                                    FROM tangkapan as a INNER JOIN satuan as b INNER JOIN users as d
                                    ON a.id_satuan=b.id_satuan AND a.created_user=d.id_user WHERE a.id_tangkapan='$_GET[id]' AND a.created_user='$_SESSION[id_user]'")
      or die('Ada kesalahan pada query tampil Data Tangkapan : ' . mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);

    $id_tangkapan   = $data['id_tangkapan'];
    $nama_tangkapan = $data['id_tangkapan'] . " | " . $data['nama_tangkapan'];
    $stok        = $data['stok'];
    $nama_satuan = $data['nama_satuan'];
  } else {
    $id_tangkapan   = "";
    $nama_tangkapan = "";
    $stok        = "";
    $nama_satuan = "";
  }
?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Data Tangkapan Masuk
    </h1>
    <br>
    <ol class="breadcrumb">
      <hr>
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=masuk"> Tangkapan Masuk </a></li>
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
          <form role="form" class="form-horizontal" action="modules/masuk/proses.php?act=insert" method="POST" name="formTangkapanMasuk">
            <div class="box-body">
              <?php
              // fungsi untuk membuat id transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_masuk,7) as kode FROM masuk
                                                ORDER BY id_masuk DESC LIMIT 1")
                or die('Ada kesalahan pada query tampil id_masuk : ' . mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                // mengambil data id_masuk
                $data_id = mysqli_fetch_assoc($query_id);
                $kode    = $data_id['kode'] + 1;
              } else {
                $kode = 1;
              }

              // buat id_masuk
              $tahun           = date("Y");
              $buat_id         = str_pad($kode, 7, "0", STR_PAD_LEFT);
              $id_masuk = "TM-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">ID Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_masuk" value="<?php echo $id_masuk; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_masuk" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-2 control-label">Tangkapan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="id_tangkapan" data-placeholder="-- Pilih Tangkapan --" onchange="tampil_tangkapan(this)" autocomplete="off" required>
                    <option value="<?php echo $id_tangkapan; ?>"><?php echo $nama_tangkapan; ?></option>
                    <?php
                    $query_tangkapan = mysqli_query($mysqli, "SELECT a.id_tangkapan,a.nama_tangkapan,a.id_jenis,a.id_satuan,a.stok,b.id_jenis,b.nama_jenis,c.id_satuan,c.nama_satuan 
                                                           FROM tangkapan as a INNER JOIN jenis_tangkapan as b INNER JOIN satuan as c
                                                           ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan ORDER BY id_tangkapan DESC")
                      or die('Ada kesalahan pada query tampil tangkapan: ' . mysqli_error($mysqli));
                    while ($data_tangkapan = mysqli_fetch_assoc($query_tangkapan)) {
                      echo "<option value=\"$data_tangkapan[id_tangkapan]\"> $data_tangkapan[nama_tangkapan] / $data_tangkapan[nama_satuan] </option>";
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
                  <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" autocomplete="off" onKeyPress="return goodchars(event,'0123456789.0123456789',this)" onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
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
                  <a href="?module=masuk" class="btn btn-default btn-reset">Batal</a>
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
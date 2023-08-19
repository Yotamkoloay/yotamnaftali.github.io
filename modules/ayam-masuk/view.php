<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-sign-in icon-title"></i> Ayam Masuk

    <a class="btn btn-primary btn-social pull-right" href="?module=form_ayam_masuk&form=add" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>
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
    // tampilkan pesan Sukses "Data Ayam Masuk berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Ayam Masuk berhasil disimpan.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
          <!-- tampilan tabel Ayam -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">ID Transaksi</th>
                <th class="center">Tanggal</th>
                <th class="center">Ayam</th>
                <th class="center">Jumlah Masuk</th>
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel Ayam
            $query = mysqli_query($mysqli, "SELECT a.id_ayam_masuk,a.tanggal_masuk,a.id_ayam,a.jumlah_masuk,b.id_kategori,b.id_ayam,b.id_satuan,c.id_satuan,c.nama_satuan,d.id_kategori,d.nama_kategori
                                            FROM ayam_masuk as a INNER JOIN ayam as b INNER JOIN satuan as c INNER JOIN kategori as d
                                            ON a.id_ayam=b.id_ayam AND b.id_kategori=d.id_kategori AND b.id_satuan=c.id_satuan ORDER BY id_ayam_masuk DESC")
                                            or die('Ada kesalahan pada query tampil Data ayam Masuk: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $tanggal         = $data['tanggal_masuk'];
              $exp             = explode('-',$tanggal);
              $tanggal_masuk   = $exp[2]."-".$exp[1]."-".$exp[0];

              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='100' class='center'>$data[id_ayam_masuk]</td>
                      <td width='90' class='center'>$tanggal_masuk</td>
                      <td width='80' class='center'>$data[nama_kategori]</td>
                      <td width='120'>$data[jumlah_masuk] $data[nama_satuan]</td>
                      <td class='center' width='40'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Tambah Data' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_ayam_masuk&form=add&id=$data[id_ayam]'>
                              <i style='color:#fff' class='glyphicon glyphicon-plus'></i>
                          </a>
                        </div>
                      </td>
                    </tr>";
              $no++;
              // <a data-toggle='tooltip' data-placement='top' title='Ubah' class='btn btn-primary btn-sm' href='?module=form_user&form=edit&id=$data[id_ayam]'>
              //                   <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
              //               </a>
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      </div>
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-sign-in icon-title"></i> Data Pemasukan

    <a class="btn btn-primary btn-social pull-right" href="?module=form_masuk&form=add" title="Tambah Data" data-toggle="tooltip">
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
      // tampilkan pesan Sukses "Data Pemasukan berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Pemasukan berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Data Pemasukan berhasil disimpan"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Pemasukan berhasil dihapus.
            </div>";
      }
      ?>
      <?php
      if ($_SESSION['hak_akses'] == 'Admin') { ?>
        <div class="box box-primary">
          <div class="box-body">
            <div class="table-responsive">
              <!-- tampilan tabel tangkapan -->
              <table id="dataTables1" class="table table-bordered table-striped table-hover">
                <!-- tampilan tabel header -->
                <thead>
                  <th class="center">No.</th>
                  <th class="center">ID Transaksi</th>
                  <th class="center">Tanggal</th>
                  <th class="center">Nama User</th>
                  <th class="center">Jenis Tangkapan</th>
                  <th class="center">Nama Tangkapan</th>
                  <th class="center">Jumlah Masuk</th>
                  <th class="center">Aksi</th>
                  </tr>
                </thead>
                <!-- tampilan tabel body -->
                <tbody>
                  <?php
                  $no = 1;

                  // fungsi query untuk menampilkan data dari tabel tangkapan
                  $query = mysqli_query($mysqli, "SELECT a.id_masuk,a.tanggal_masuk,a.id_tangkapan,a.jumlah_masuk,a.created_user,b.id_tangkapan,b.nama_tangkapan,b.id_satuan,b.id_jenis,c.id_satuan,c.nama_satuan,d.id_user,d.nama_user,e.id_jenis,e.nama_jenis
                                            FROM masuk as a INNER JOIN tangkapan as b INNER JOIN satuan as c INNER JOIN users as d inner join jenis_tangkapan as e
                                            ON b.id_jenis=e.id_jenis AND a.id_tangkapan=b.id_tangkapan AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user  ORDER BY id_masuk DESC ")
                    or die('Ada kesalahan pada query tampil Data Pemasukan : ' . mysqli_error($mysqli));

                  // tampilkan data
                  while ($data = mysqli_fetch_assoc($query)) {
                    $tanggal         = $data['tanggal_masuk'];
                    $exp             = explode('-', $tanggal);
                    $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];


                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "<tr>
                      <td width='20' class='center'>$no</td>
                      <td width='100' class='center'>$data[id_masuk]</td>
                      <td width='90' class='center'>$tanggal_masuk</td>
                      <td width='80' class='center'>$data[nama_user]</td>
                      <td width='80' class='center'>$data[nama_jenis]</td>
                      <td width='80' class='center'>$data[nama_tangkapan]</td>
                      <td width='90' class='center'>$data[jumlah_masuk] $data[nama_satuan]</td>
                      <td class='center' width='70'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Tambah Data' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_masuk&form=add&id=$data[id_tangkapan]'>
                              <i style='color:#fff' class='glyphicon glyphicon-plus'></i>
                          </a>"
                  ?>
                    <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/masuk/proses.php?act=delete&id=<?php echo $data['id_masuk']; ?>" onclick="return confirm('Anda yakin ingin menghapus Pemasukan dengan ID <?php echo $data['id_masuk']; ?> ?');">
                      <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                    </a>
                  <?php
                    echo "</div>
                      </td>
                    </tr>";
                    $no++;
                    // <a data-toggle='tooltip' data-placement='top' title='Ubah' class='btn btn-primary btn-sm' href='?module=form_user&form=edit&id=$data[id_tangkapan]'>
                    //                   <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                    //               </a>
                  }
                  ?>

                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
    </div>
    <!--/.col -->
  <?php
      } elseif ($_SESSION['hak_akses'] == 'User') { ?>
    <div class="box box-primary">
      <div class="box-body">
        <div class="table-responsive">
          <!-- tampilan tabel tangkapan -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">ID Transaksi</th>
                <th class="center">Tanggal</th>
                <th class="center">Jenis Tangkapan</th>
                <th class="center">Nama Tangkapan</th>
                <th class="center">Jumlah Masuk</th>
                <th class="center">Aksi</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;

              // fungsi query untuk menampilkan data dari tabel tangkapan
              $query = mysqli_query($mysqli, "SELECT a.id_masuk,a.tanggal_masuk,a.id_tangkapan,a.jumlah_masuk,a.created_user,b.id_tangkapan,b.nama_tangkapan,b.id_satuan,b.id_jenis,c.id_satuan,c.nama_satuan,d.id_user,e.id_jenis,e.nama_jenis
                                            FROM masuk as a INNER JOIN tangkapan as b INNER JOIN satuan as c INNER JOIN users as d inner join jenis_tangkapan as e
                                            ON b.id_jenis=e.id_jenis AND a.id_tangkapan=b.id_tangkapan AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user WHERE d.id_user='$_SESSION[id_user]' ORDER BY id_masuk  DESC ")
                or die('Ada kesalahan pada query tampil Data Pemasukan : ' . mysqli_error($mysqli));

              // tampilkan data
              while ($data = mysqli_fetch_assoc($query)) {
                $tanggal         = $data['tanggal_masuk'];
                $exp             = explode('-', $tanggal);
                $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];


                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                      <td width='20' class='center'>$no</td>
                      <td width='100' class='center'>$data[id_masuk]</td>
                      <td width='90' class='center'>$tanggal_masuk</td>
                      <td width='80' class='center'>$data[nama_jenis]</td>
                      <td width='80' class='center'>$data[nama_tangkapan]</td>
                      <td width='90' class='center'>$data[jumlah_masuk] $data[nama_satuan]</td>
                      <td class='center' width='70'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Tambah Data' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_masuk&form=add&id=$data[id_tangkapan]'>
                              <i style='color:#fff' class='glyphicon glyphicon-plus'></i>
                          </a>"
              ?>
                <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/masuk/proses.php?act=delete&id=<?php echo $data['id_masuk']; ?>" onclick="return confirm('Anda yakin ingin menghapus Pemasukan dengan ID <?php echo $data['id_masuk']; ?> ?');">
                  <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                </a>
              <?php
                echo "</div>
                      </td>
                    </tr>";
                $no++;
                // <a data-toggle='tooltip' data-placement='top' title='Ubah' class='btn btn-primary btn-sm' href='?module=form_user&form=edit&id=$data[id_tangkapan]'>
                //                   <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                //               </a>
              }
              ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
  <!--/.col -->
<?php
      }
?>
</div> <!-- /.row -->
</section><!-- /.content
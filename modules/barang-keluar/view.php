<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-sign-out icon-title"></i> Permintaan

    <a class="btn btn-primary btn-social pull-right" href="?module=form_barang_keluar&form=add" title="Tambah Data" data-toggle="tooltip">
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
    // tampilkan pesan Sukses "Data Barang Keluar berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan berhasil disimpan.
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "Data Barang Keluar telah disetujui"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan telah disetujui.
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "Data Barang Keluar telah ditolak"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan telah ditolak.
            </div>";
    }
     // jika alert = 3
    // tampilkan pesan Sukses "Data Barang Keluar telah diubah"
    elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan telah diubah.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
          <!-- tampilan tabel barang -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Tanggal</th>
                <th class="center">Pengguna</th>
                <th class="center">NIP</th>
                <th class="center">Tim</th>
                <th class="center">Nama Barang</th>
                <th class="center">Jumlah Keluar</th>
                <th class="center">Status</th>
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel barang
            $query = mysqli_query($mysqli, "SELECT a.id_barang_keluar,a.created_user,a.tanggal_keluar,a.id_barang,a.jumlah_keluar,a.id_tim,a.status,b.id_barang,b.nama_barang,b.id_satuan,b.stok,c.id_satuan,c.nama_satuan,d.username,d.nama_user,d.id_user,d.NIP,e.id_tim,e.nama_tim
                                            FROM is_barang_keluar as a INNER JOIN is_barang as b INNER JOIN is_satuan as c INNER JOIN is_users as d INNER JOIN is_tim as e
                                            ON a.id_barang=b.id_barang AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user AND a.id_tim=e.id_tim
                                            ORDER BY id_barang_keluar DESC")
                                            or die('Ada kesalahan pada query tampil Data Barang Keluar: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $tanggal        = $data['tanggal_keluar'];
              $exp            = explode('-',$tanggal);
              $tanggal_keluar = $exp[2]."-".$exp[1]."-".$exp[0];

              if ($_SESSION['hak_akses']=='BMN') {
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                        <td width='30' class='center'>$no</td>
                        <td width='100' class='center'>$tanggal_keluar</td>
                        <td width='90' class='center'>$data[username]</td>
                        <td width='90' class='center'>$data[NIP]</td>
                        <td width='80' class='center'>$data[nama_tim]</td>
                        <td width='150'>$data[nama_barang]</td>
                        <td width='100'>$data[jumlah_keluar] $data[nama_satuan]</td>
                        <td width='70' class='center'>$data[status]</td>";

                if ($data['status']=='Proses') {
                  echo "<td class='center' width='110'>
                          <a data-toggle='tooltip' data-placement='top' title='Approve' style='margin-right:5px' class='btn btn-success btn-sm' href='modules/barang-keluar/proses.php?act=approve&id=$data[id_barang_keluar]&jml=$data[jumlah_keluar]&idb=$data[id_barang]&stok=$data[stok]'>
                              <i style='color:#fff' class='glyphicon glyphicon-ok'></i>
                          </a>

                          <a data-toggle='tooltip' data-placement='top' title='Reject' style='margin-right:5px' class='btn btn-danger btn-sm' href='modules/barang-keluar/proses.php?act=reject&id=$data[id_barang_keluar]'>
                              <i style='color:#fff' class='glyphicon glyphicon-remove'></i>
                          </a>

                          <a data-toggle='tooltip' data-placement='top' title='Ubah Data' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_barang_keluar&form=edit&id=$data[id_barang_keluar]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>
                      </td>";
                 } elseif ($data['status']=='Approve') {

                    echo "<td class='center' width='40'>
                          <a data-toggle='tooltip' data-placement='top' title='Cetak' style='margin-right:5px' class='btn btn-primary btn-sm' href='modules/barang-keluar/cetak.php?id=$data[created_user]&tgl=$data[tanggal_keluar]&tim=$data[id_tim]&nt=$data[nama_tim]&nama=$data[username]&np=$data[NIP]&nl=$data[nama_user]'>
                              <i style='color:#fff' class='fa fa-print'></i>
                          </a>
                        </td>";
                  }elseif ($data['status']=='Reject') {

                    echo "<td class='center' width='40'>
                        </td>";
                  }
                        
                  echo "</tr>";
              } else {
                
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                        <td width='30' class='center'>$no</td>
                        <td width='100' class='center'>$tanggal_keluar</td>
                        <td width='90' class='center'>$data[username]</td>
                        <td width='90' class='center'>$data[NIP]</td>
                        <td width='80' class='center'>$data[nama_tim]</td>
                        <td width='150'>$data[nama_barang]</td>
                        <td width='120'>$data[jumlah_keluar] $data[nama_satuan]</td>
                        <td width='100' class='center'>$data[status]</td>
                        <td class='center' width='40'>
                        <a data-toggle='tooltip' data-placement='top' title='Tambah Data' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_barang_keluar&form=adds&id=$data[id_barang]&tim=$data[nama_tim]'>
                        <i style='color:#fff' class='glyphicon glyphicon-plus'></i>
                    </a>
                        </td>
                      </tr>";
              }
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div>
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content
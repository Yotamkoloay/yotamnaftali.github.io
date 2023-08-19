<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-sign-out icon-title"></i> Permintaan

    <a class="btn btn-primary btn-social pull-right" href="?module=form_ayam_keluar&form=add" title="Tambah Data" data-toggle="tooltip">
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
    // tampilkan pesan Sukses "Data Ayam Keluar berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan berhasil disimpan.
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "Data Ayam Keluar telah disetujui"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan telah disetujui.
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "Data Ayam Keluar telah ditolak"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan telah ditolak.
            </div>";
    }
     // jika alert = 3
    // tampilkan pesan Sukses "Data Ayam Keluar telah diubah"
    elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Permintaan telah diubah.
            </div>";
    }
    ?>
 <?php
      if ($_SESSION['hak_akses'] == 'Penjual') { ?>
        <!-- Content Header (Page header) -->

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
          <!-- tampilan tabel Ayam -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Tanggal</th>
                <th class="center">Pengguna</th>
                <th class="center">Nama Ayam</th>
                <th class="center">Jumlah Keluar</th>
                <th class="center">Ditawar</th>
                <th class="center">Total Harga</th>
                <th class="center">Status</th>
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel ayam
            $query = mysqli_query($mysqli, "SELECT a.id_ayam_keluar,a.created_user,a.harga,a.tanggal_keluar,a.id_ayam,a.jumlah_keluar,a.status,b.id_ayam,b.id_satuan,b.stok,c.id_satuan,c.nama_satuan,d.username,d.id_user,e.id_kategori,e.nama_kategori
                                            FROM ayam_keluar as a INNER JOIN ayam as b INNER JOIN satuan as c INNER JOIN users as d INNER JOIN kategori as e
                                            ON a.id_ayam=b.id_ayam AND b.id_satuan=c.id_satuan AND b.id_kategori=e.id_kategori AND a.created_user=d.id_user and a.created_user=d.id_user  ORDER BY id_ayam_keluar DESC")
                                            or die('Ada kesalahan pada query tampil Data Ayam Keluar: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $harga = format_rupiah($data['harga']);
              $tot_harga = format_rupiah($data['harga'] * $data['jumlah_keluar'] );
                           $tanggal        = $data['tanggal_keluar'];
              $exp            = explode('-',$tanggal);
              $tanggal_keluar = $exp[2]."-".$exp[1]."-".$exp[0];

              
        
              if ($_SESSION['hak_akses']=='Penjual') {
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                <td width='30' class='center'>$no</td>
                <td width='100' class='center'>$tanggal_keluar</td>
                <td width='90' class='center'>$data[username]</td>
                <td width='150'>$data[nama_kategori]</td>
                <td width='120'>$data[jumlah_keluar] $data[nama_satuan]</td>  
                <td width='120'> Rp.$harga</td>
                <td width='120'> Rp.$tot_harga</td>
                <td width='100' class='center'>$data[status]</td>";
                

                if ($data['status']=='Proses') {
                  echo "<td class='center' width='110'>
                          <a data-toggle='tooltip' data-placement='top' title='Approve' style='margin-right:5px' class='btn btn-success btn-sm' href='modules/ayam-keluar/proses.php?act=approve&id=$data[id_ayam_keluar]&jml=$data[jumlah_keluar]&idb=$data[id_ayam]&stok=$data[stok]'>
                              <i style='color:#fff' class='glyphicon glyphicon-ok'></i>
                          </a>

                          <a data-toggle='tooltip' data-placement='top' title='Reject' style='margin-right:5px' class='btn btn-danger btn-sm' href='modules/ayam-keluar/proses.php?act=reject&id=$data[id_ayam_keluar]'>
                              <i style='color:#fff' class='glyphicon glyphicon-remove'></i>
                          </a>

                          <a data-toggle='tooltip' data-placement='top' title='Ubah Data' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_ayam_keluar&form=edit&id=$data[id_ayam_keluar]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>
                      </td>";
                 } elseif ($data['status']=='Approve') {

                    echo "<td class='center' width='40'>
                          <a data-toggle='tooltip' data-placement='top' title='Cetak' style='margin-right:5px' class='btn btn-primary btn-sm' href='modules/ayam-keluar/cetak.php?id=$data[created_user]&tgl=$data[tanggal_keluar]&nama=$data[username]'>
                              <i style='color:#fff' class='fa fa-print'></i>
                          </a>
                        </td>";
                  }elseif ($data['status']=='Reject') {

                    echo "<td class='center' width='40'>
                        </td>";
                      }
                      echo "</tr>";
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
    <?php
      } elseif ($_SESSION['hak_akses'] == 'Admin') { ?>
        <!-- Content Header (Page header) -->

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
          <!-- tampilan tabel Ayam -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Tanggal</th>
                <th class="center">Pengguna</th>
                <th class="center">Nama Ayam</th>
                <th class="center">Jumlah Keluar</th>
                <th class="center">Ditawar</th>
                <th class="center">Total Harga</th>
                <th class="center">Status</th>
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel ayam
            $query = mysqli_query($mysqli, "SELECT a.id_ayam_keluar,a.created_user,a.harga,a.tanggal_keluar,a.id_ayam,a.jumlah_keluar,a.status,b.id_ayam,b.nama_kategori,b.id_kategori,b.id_satuan,b.stok,c.id_satuan,c.nama_satuan,d.username,d.id_user
                                            FROM ayam_keluar as a INNER JOIN ayam as b INNER JOIN satuan as c INNER JOIN users as d  INNER JOIN kategori as e 
                                            ON a.id_ayam=b.id_ayam AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user and a.created_user=d.id_user  ORDER BY id_ayam_keluar DESC")
                                            or die('Ada kesalahan pada query tampil Data Ayam Keluar: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $harga = format_rupiah($data['harga']);
              $tot_harga = format_rupiah($data['harga'] * $data['jumlah_keluar'] );
                           $tanggal        = $data['tanggal_keluar'];
              $exp            = explode('-',$tanggal);
              $tanggal_keluar = $exp[2]."-".$exp[1]."-".$exp[0];

              
        
              if ($_SESSION['hak_akses']=='Admin') {
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                <td width='30' class='center'>$no</td>
                <td width='100' class='center'>$tanggal_keluar</td>
                <td width='90' class='center'>$data[username]</td>
                <td width='150'>$data[nama_kategori]</td>
                <td width='120'>$data[jumlah_keluar] $data[nama_satuan]</td>  
                <td width='120'> Rp.$harga</td>
                <td width='120'> Rp.$tot_harga</td>
                <td width='100' class='center'>$data[status]</td>";
                

                if ($data['status']=='Proses') {
                  echo "<td class='center' width='110'>
                          <a data-toggle='tooltip' data-placement='top' title='Approve' style='margin-right:5px' class='btn btn-success btn-sm' href='modules/ayam-keluar/proses.php?act=approve&id=$data[id_ayam_keluar]&jml=$data[jumlah_keluar]&idb=$data[id_ayam]&stok=$data[stok]'>
                              <i style='color:#fff' class='glyphicon glyphicon-ok'></i>
                          </a>

                          <a data-toggle='tooltip' data-placement='top' title='Reject' style='margin-right:5px' class='btn btn-danger btn-sm' href='modules/ayam-keluar/proses.php?act=reject&id=$data[id_ayam_keluar]'>
                              <i style='color:#fff' class='glyphicon glyphicon-remove'></i>
                          </a>

                          <a data-toggle='tooltip' data-placement='top' title='Ubah Data' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_ayam_keluar&form=edit&id=$data[id_ayam_keluar]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>
                      </td>";
                 } elseif ($data['status']=='Approve') {

                    echo "<td class='center' width='40'>
                          <a data-toggle='tooltip' data-placement='top' title='Cetak' style='margin-right:5px' class='btn btn-primary btn-sm' href='modules/ayam-keluar/cetak.php?id=$data[created_user]&tgl=$data[tanggal_keluar]&nama=$data[username]'>
                              <i style='color:#fff' class='fa fa-print'></i>
                          </a>
                        </td>";
                  }elseif ($data['status']=='Reject') {

                    echo "<td class='center' width='40'>
                        </td>";
                      }
                      echo "</tr>";
                    }
              $no++;
            }
            ?>
              <?php
      } elseif ($_SESSION['hak_akses'] == 'Pembeli') { ?>
        <!-- Content Header (Page header) -->

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
          <!-- tampilan tabel Ayam -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Tanggal</th>
                <th class="center">Pengguna</th>
                <th class="center">Nama Ayam</th>
                <th class="center">Jumlah Keluar</th>
                <th class="center">Ditawar</th>
                <th class="center">Total Harga</th>
                <th class="center">Status</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel ayam
            $query = mysqli_query($mysqli, "SELECT a.id_ayam_keluar,a.created_user,a.harga,a.tanggal_keluar,a.id_ayam,a.jumlah_keluar,a.status,a.created_user,b.id_ayam,b.id_satuan,b.stok,c.id_satuan,c.nama_satuan,d.username,d.id_user,e.id_kategori,e.nama_kategori
                                            FROM ayam_keluar as a INNER JOIN ayam as b INNER JOIN satuan as c INNER JOIN users as d INNER JOIN kategori as e
                                            ON a.id_ayam=b.id_ayam AND b.id_satuan=c.id_satuan AND b.id_kategori=e.id_kategori AND a.created_user=d.id_user and a.created_user=d.id_user Where id_user=$_SESSION[id_user] ORDER BY id_ayam_keluar  DESC")
                                            or die('Ada kesalahan pada query tampil Data Ayam Keluar: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $harga = format_rupiah($data['harga']);
              $tot_harga = format_rupiah($data['harga'] * $data['jumlah_keluar'] );
                           $tanggal        = $data['tanggal_keluar'];
              $exp            = explode('-',$tanggal);
              $tanggal_keluar = $exp[2]."-".$exp[1]."-".$exp[0];

              
        
              if ($_SESSION['hak_akses']=='Pembeli') {
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                <td width='30' class='center'>$no</td>
                <td width='100' class='center'>$tanggal_keluar</td>
                <td width='90' class='center'>$data[username]</td>
                <td width='150'>$data[nama_kategori]</td>
                <td width='120'>$data[jumlah_keluar] $data[nama_satuan]</td>  
                <td width='120'> Rp.$harga</td>
                <td width='120'> Rp.$tot_harga</td>
                <td width='100' class='center'>$data[status]</td>";
                

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
   
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div>
      </div><!-- /.box -->
    </div><!--/.col -->
    <?php
      }
?>
  </div>   <!-- /.row -->
  </section><!-- /.content
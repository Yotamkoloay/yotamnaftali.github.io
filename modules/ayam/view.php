<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Ayam Daging

    <a class="btn btn-primary btn-social pull-right" href="?module=form_ayam&form=add" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />


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
      // tampilkan pesan Sukses "Profil user berhasil diubah"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Ayam user berhasil diubah.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload sudah benar"
      elseif ($_GET['alert'] == 2) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload sudah benar.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Upload Gagal "Pastikan ukuran foto tidak lebih dari 1MB"
      elseif ($_GET['alert'] == 3) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan ukuran foto tidak lebih dari 1MB.
            </div>";
      }
      // jika alert = 4
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
      elseif ($_GET['alert'] == 4) {
        echo "  <div class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              <strong><i class='fa fa-check-circle'></i> Upload Gagal!</strong> Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
            </div>";
      }
      // jika alert = 1
      // tampilkan pesan Sukses "Profil user berhasil diubah"
      elseif ($_GET['alert'] == 5) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Ayam berhasil dihapus.
            </div>";
      }

      ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <!-- tampilan tabel Penilaian -->
            <table id="dataTables1" class="table table-bordered table-striped table-hover">
              <!-- tampilan tabel header -->
              <thead>
                <tr>
                  <th class="center">No</th>
                  <th class="center">kategori</th>
                  <th class="center">harga</th>
                  <th class="center">foto</th>
                  <th class="center">keterangan</th>
                  <th class="center">Ubah</th>

                  <th class="center">Hapus</th>

                </tr>
              </thead>
              <!-- tampilan tabel body -->
              <tbody>
                <?php
                $no = 1;
                // fungsi query untuk menampilkan data dari tabel Penilaian
                $query = mysqli_query($mysqli, "SELECT a.id_kategori,a.id_ayam, a.id_satuan, a.harga, a.foto, a.keterangan,a.created_user,  b.id_kategori, b.nama_kategori, c.id_satuan, c.nama_satuan,d.id_user
                 FROM ayam as a inner join kategori as b  inner join satuan as c INNER JOIN users as d
                                            on a.id_kategori=b.id_kategori  and a.id_satuan=c.id_satuan and a.created_user=d.id_user Where id_user=$_SESSION[id_user] Group BY a.id_ayam asc")
                  or die('Ada kesalahan pada query tampil Data Penilaian: ' . mysqli_error($mysqli));

                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {

                  // menampilkan isi tabel dari database ke tabel di aplikasi
                  echo "<tr>
                  <td width='30' class='center'>$no</td>                      
                      <td class='center'>$data[nama_kategori]</td>
                      <td class='center'>$data[harga]</td>
										<td width='100' class='center'><img src='assets/img/ayam/$data[foto]' width='100%'> </td>
                      <td class='center'>$data[keterangan]</td>
                      

                      <td class='center' width='40'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin: 6px 12px 6px 12px'  class='btn btn-primary btn-sm' href='?module=form_ayam&form=edit&id=$data[id_ayam]&foto=$data[foto]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a> 
                          </td>
                          <td width='40' class='center'>";
                ?>
                  <a data-toggle="tooltip" data-placement="top" title="Hapus" style='margin: 6px 12px 6px 12px' class="btn btn-danger btn-sm" href="modules/ayam/proses.php?act=delete&id=<?php echo $data['id_ayam']; ?> " onclick="return confirm('Anda yakin ingin menghapus Data  Tersebut  ?') ;">
                    <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                  </a>
                <?php
                  echo "    </div>
                      </td>
                    </tr>";
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
    <!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content
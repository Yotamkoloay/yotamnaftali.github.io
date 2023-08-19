<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-user icon-title"></i> Manajemen User

    <a class="btn btn-primary btn-social pull-right" href="?module=form_admin&form=add" title="Tambah Data" data-toggle="tooltip">
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
      // tampilkan pesan Sukses "Data user baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data user baru berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Data user berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data user berhasil diubah.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "User berhasil diaktifkan"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              User berhasil diaktifkan.
            </div>";
      }
      // jika alert = 4
      // tampilkan pesan Sukses "User berhasil diblokir"
      elseif ($_GET['alert'] == 4) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              User berhasil diblokir.
            </div>";
      }
      // jika alert = 5
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload sudah benar"
      elseif ($_GET['alert'] == 5) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan file yang diupload sudah benar.
            </div>";
      }
      // jika alert = 6
      // tampilkan pesan Upload Gagal "Pastikan ukuran foto tidak lebih dari 1MB"
      elseif ($_GET['alert'] == 6) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan ukuran foto tidak lebih dari 1MB.
            </div>";
      }
      // jika alert = 7
      // tampilkan pesan Upload Gagal "Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
      elseif ($_GET['alert'] == 7) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Upload Gagal!</h4>
              Pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <!-- tampilan tabel user -->
            <table id="dataTables1" class="table table-bordered table-striped table-hover">
              <!-- tampilan tabel header -->
              <thead>
                <tr>
                  <th class="center">No.</th>
                  <th class="center">Username</th>
                  <th class="center">ID Profil</th>
                  <th class="center">Status</th>
                  <th class="center">Sebagai</th>
                  <th class="center"></th>
                </tr>
              </thead>
              <!-- tampilan tabel body -->
              <tbody>
                <?php
                $no = 1;
                /// fungsi query untuk menampilkan data dari tabel user
                $query = mysqli_query($mysqli, "SELECT a.id_user,a.status,a.username,a.hak_akses,a.id_profil FROM users as a  WHERE hak_akses !='Admin' ORDER BY a.id_user DESC")
                  or die('Ada kesalahan pada query tampil data user: ' . mysqli_error($mysqli));

                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                  // menampilkan isi tabel dari database ke tabel di aplikasi
                  echo "<tr>
                      <td width='50' class='center'>$no</td>";

                 ?>
                 
                  <?php
                 

                  echo "  <td>$data[username]</td>
                      <td>$data[id_profil]</td>
                      <td>$data[status]</td>
                      <td>$data[hak_akses]</td>

                      <td class='center' width='100'>
                          <div>";

                  if ($data['status'] == 'aktif') { ?>
                    <a data-toggle="tooltip" data-placement="top" title="Blokir" style="margin-right:5px" class="btn btn-warning btn-sm" href="modules/user/proses_admin.php?act=off&id=<?php echo $data['id_user']; ?>" onclick="return confirm('Anda Yakin Blokir User <?php echo $data['nama_user']; ?> ?');">
                      <i style="color:#fff" class="glyphicon glyphicon-off"></i>
                    </a>
                  <?php
                  } else { ?>
                    <a data-toggle="tooltip" data-placement="top" title="Aktifkan" style="margin-right:5px" class="btn btn-success btn-sm" href="modules/user/proses_admin.php?act=on&id=<?php echo $data['id_user']; ?>" onclick="return confirm('Anda Yakin Mengaktifkan User Ini ?');">
                      <i style=" color:#fff" class="glyphicon glyphicon-ok"></i>
                    </a>
                <?php
                  }

                  echo "      <a data-toggle='tooltip' data-placement='top' title='Ubah' class='btn btn-primary btn-sm' href='?module=form_admin&form=edit&id=$data[id_user]'>
                                <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                            </a>
                          </div>
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
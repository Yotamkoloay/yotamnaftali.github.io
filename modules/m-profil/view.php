<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Data Profil User

    <a class="btn btn-primary btn-social pull-right" href="?module=form_m-profil&form=add" title="Tambah Data" data-toggle="tooltip">
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
      // tampilkan pesan Sukses "Profil User baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Profil User baru berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Profil User berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Profil User berhasil diubah.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "Profil User berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Profil User berhasil dihapus.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <!-- tampilan tabel Profil User -->
            <table id="dataTables1" class="table table-bordered table-striped table-hover">
              <!-- tampilan tabel header -->
              <thead>
                <tr>
                  <th class="center">No.</th>
                  <th class="center">Profil User</th>
                  <th class="center">Telepon User</th>
                  <th></th>
                </tr>
              </thead>
              <!-- tampilan tabel body -->
              <tbody>
                <?php
                $no = 1;
                // fungsi query untuk menampilkan data dari tabel Profil User
                $query = mysqli_query($mysqli, "SELECT * FROM profil ORDER BY id_profil DESC")
                  or die('Ada kesalahan pada query tampil Data profil Ikan: ' . mysqli_error($mysqli));

                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                  // menampilkan isi tabel dari database ke tabel di aplikasi
                  echo "<tr>
                      <td width='40' class='center'>$no</td>
                      <td width='350'>$data[nama]</td>
                      <td width='350'>$data[telepon]</td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_profil&form=edit&id=$data[id_profil]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";
                ?>
                  <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/m-profil/proses.php?act=delete&id=<?php echo $data['id_profil']; ?>" onclick="return confirm('Anda yakin ingin menghapus Profil Ikan <?php echo $data['nama']; ?> ?');">
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
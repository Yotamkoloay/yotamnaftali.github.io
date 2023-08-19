<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Data Jenis Bagan

    <a class="btn btn-primary btn-social pull-right" href="?module=form_jenis_bagan&form=add" title="Tambah Data" data-toggle="tooltip">
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
      // tampilkan pesan Sukses "Jenis Bagan baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Jenis Bagan baru berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Jenis Bagan berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Jenis Bagan berhasil diubah.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "Jenis Bagan berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Jenis Bagan berhasil dihapus.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <!-- tampilan tabel jenis -->
            <table id="dataTables1" class="table table-bordered table-striped table-hover">
              <!-- tampilan tabel header -->
              <thead>
                <tr>
                  <th class="center">No.</th>
                  <th class="center">Jenis Bagan</th>
                  <th class="center">Ubah</th>
                  <th class="center">Hapus</th>
                </tr>
              </thead>
              <!-- tampilan tabel body -->
              <tbody>
                <?php
                $no = 1;
                // fungsi query untuk menampilkan data dari tabel jenis
                $query = mysqli_query($mysqli, "SELECT * FROM jenis_bagan ORDER BY id_jenis_bagan DESC")
                  or die('Ada kesalahan pada query tampil Data Jenis Bagan: ' . mysqli_error($mysqli));

                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                  // menampilkan isi tabel dari database ke tabel di aplikasi
                  echo "<tr>
                      <td class='center' width='40'>$no</td>
                      <td class='center' width='350'>$data[jenis_bagan]</td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' sstyle='margin: 6px 12px 6px 12px' class='btn btn-primary btn-sm' href='?module=form_jenis_bagan&form=edit&id=$data[id_jenis_bagan]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a> </td>
                          <td width='40' class='center'>";
                ?>
                  <a data-toggle="tooltip" data-placement="top" title="Hapus" style='margin: 6px 12px 6px 12px' class="btn btn-danger btn-sm" href="modules/jenis_bagan/proses.php?act=delete&id=<?php echo $data['id_jenis_bagan']; ?>" onclick="return confirm('Anda yakin ingin menghapus Jenis Bagan <?php echo $data['jenis_bagan']; ?> ?');">
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
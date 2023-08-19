<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Data Tangkapan

    <a class="btn btn-primary btn-social pull-right" href="?module=form_tangkapan&form=add" title="Tambah Data" data-toggle="tooltip">
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
      // tampilkan pesan Sukses "Data tangkapan baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Tangkapan baru berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Data tangkapan berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Tangkapan berhasil diubah.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "Data tangkapan berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Tangkapan berhasil dihapus.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <!-- tampilan tabel tangkapan -->
            <table id="dataTables1" class="table table-bordered table-striped table-hover">
              <!-- tampilan tabel header -->
              <thead>
                <tr>
                  <th class="center">No.</th>
                  <th class="center">Nama Tangkapan</th>
                  <th class="center">Jenis Tangkapan</th>

                  <th class="center">Stok</th>
                  <th class="center">Satuan</th>
                  <th class="center">Aksi</th>
                </tr>
              </thead>
              <!-- tampilan tabel body -->
              <tbody>
                <?php
                $no = 1;
                // fungsi query untuk menampilkan data dari tabel tangkapan
                $query = mysqli_query($mysqli, "SELECT a.id_tangkapan,a.nama_tangkapan,a.id_satuan,a.stok,a.id_jenis,a.created_user,b.id_jenis,b.nama_jenis,c.id_satuan,c.nama_satuan,d.id_user 
                                            FROM tangkapan as a INNER JOIN jenis_tangkapan as b INNER JOIN satuan as c INNER JOIN users as d
                                            ON  a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan AND a.created_user=d.id_user ORDER BY created_user DESC")
                  or die('Ada kesalahan pada query tampil Data Tangkapan: ' . mysqli_error($mysqli));

                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {

                  // menampilkan isi tabel dari database ke tabel di aplikasi
                  echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='180' align='center'>$data[nama_tangkapan]</td>
                      <td width='180' align='center'>$data[nama_jenis]</td>

                      <td width='80' align='center'>$data[stok]</td>
                      <td width='100'>$data[nama_satuan]</td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_tangkapan&form=edit&id=$data[id_tangkapan]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";
                ?>
                  <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/tangkapan/proses.php?act=delete&id=<?php echo $data['id_tangkapan']; ?>" onclick="return confirm('Anda yakin ingin menghapus Tangkapan <?php echo $data['nama_tangkapan']; ?> ?');">
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
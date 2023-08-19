<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-file-text-o icon-title"></i> Laporan Stok Tangkapan

    <a class="btn btn-primary btn-social pull-right" href="modules/lap-stok/cetak.php" target="_blank">
      <i class="fa fa-print"></i> Cetak
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
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
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel tangkapan
              $query = mysqli_query($mysqli, "SELECT a.id_tangkapan,a.nama_tangkapan,a.id_jenis,a.id_satuan,a.stok,b.id_jenis,b.nama_jenis,c.id_satuan,c.nama_satuan 
                                            FROM tangkapan as a INNER JOIN jenis_tangkapan as b INNER JOIN satuan as c
                                            ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan ORDER BY id_tangkapan DESC")
                or die('Ada kesalahan pada query tampil Data Tangkapan: ' . mysqli_error($mysqli));

              // tampilkan data
              while ($data = mysqli_fetch_assoc($query)) {
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='200'>$data[nama_tangkapan]</td>
                      <td width='170'>$data[nama_jenis]</td>";
                if ($data['stok'] <= 0) { ?>
                  <td width="80" align="right"><span class="label label-primary"><?php echo $data['stok']; ?></span></td>
                <?php
                } elseif ($data['stok'] <= 10) { ?>
                  <td width="80" align="right"><span class="label label-warning"><?php echo $data['stok']; ?></span></td>
                <?php
                } else { ?>
                  <td width="80" align="right"><?php echo $data['stok']; ?></td>
              <?php
                }
                echo "   <td width='100'>$data[nama_satuan]</td>
                    </tr>";
                $no++;
              }
              ?>
            </tbody>
          </table>
          <div>
            <strong>Keterangan :</strong> <br>
            <a class="btn btn-primary" href="modules/lap-stok/cetakh.php" target="_blank">
            </a> = Stok Habis <br>
            <div>
              <a class="btn btn-warning" href="modules/lap-stok/cetakk.php" target="_blank">
              </a> = Stok Kurang
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content
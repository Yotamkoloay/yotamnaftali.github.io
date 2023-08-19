<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

if (isset($_POST['dataidtangkapan'])) {
  $id_tangkapan = $_POST['dataidtangkapan'];

  // fungsi query untuk menampilkan data dari tabel tangkapan
  $query = mysqli_query($mysqli, "SELECT a.id_tangkapan,a.nama_tangkapan,a.id_satuan,a.stok,b.id_satuan,b.nama_satuan 
                                  FROM tangkapan as a INNER JOIN satuan as b ON a.id_satuan=b.id_satuan 
                                  WHERE id_tangkapan='$id_tangkapan'")
    or die('Ada kesalahan pada query tampil data Tangkapan: ' . mysqli_error($mysqli));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  $stok   = $data['stok'];
  $satuan = $data['nama_satuan'];

  if ($stok != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='$stok' readonly>
                    <span class='input-group-addon'>$satuan</span>
                  </div>
                </div>
              </div>";
  } else {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='Stok Tangkapan tidak ditemukan' readonly>
                    <span class='input-group-addon'>Satuan Tangkapan tidak ditemukan</span>
                  </div>
                </div>
              </div>";
  }
}

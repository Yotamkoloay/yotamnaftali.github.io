<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $id_tangkapan    = mysqli_real_escape_string($mysqli, trim($_POST['id_tangkapan']));
            $nama_tangkapan  = mysqli_real_escape_string($mysqli, trim($_POST['nama_tangkapan']));
            $id_jenis  = mysqli_real_escape_string($mysqli, trim($_POST['jenis']));

            $id_satuan    = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));

            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel Tangkapan
            $query = mysqli_query($mysqli, "INSERT INTO tangkapan(id_tangkapan,nama_tangkapan,id_jenis,id_satuan,created_user,updated_user) 
                                            VALUES('$id_tangkapan','$nama_tangkapan','$id_jenis','$id_satuan','$created_user','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=tangkapan&alert=1");
            }
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_tangkapan'])) {
                // ambil data hasil submit dari form
                $id_tangkapan    = mysqli_real_escape_string($mysqli, trim($_POST['id_tangkapan']));
                $nama_tangkapan  = mysqli_real_escape_string($mysqli, trim($_POST['nama_tangkapan']));
                $id_jenis  = mysqli_real_escape_string($mysqli, trim($_POST['jenis']));

                $id_satuan    = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));

                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel Tangkapan
                $query = mysqli_query($mysqli, "UPDATE tangkapan SET nama_tangkapan    = '$nama_tangkapan',
                                                                     id_jenis      = '$id_jenis',
                                                                     id_satuan      = '$id_satuan',
                                                                     updated_user   = '$updated_user'
                                                               WHERE id_tangkapan      = '$id_tangkapan'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=tangkapan&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $id_tangkapan = $_GET['id'];

            // perintah query untuk menghapus data pada tabel Tangkapan
            $query = mysqli_query($mysqli, "DELETE FROM tangkapan WHERE id_tangkapan='$id_tangkapan'")
                or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=tangkapan&alert=3");
            }
        }
    }
}

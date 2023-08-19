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
            $jenis_bagan  = mysqli_real_escape_string($mysqli, trim($_POST['jenis_bagan']));
            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel jenis bagan
            $query = mysqli_query($mysqli, "INSERT INTO jenis_bagan(jenis_bagan,created_user,updated_user) 
                                            VALUES('$jenis_bagan','$created_user','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=jenis_bagan&alert=1");
            }
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_jenis_bagan'])) {
                // ambil data hasil submit dari form
                $id_jenis_bagan    = mysqli_real_escape_string($mysqli, trim($_POST['id_jenis_bagan']));
                $jenis_bagan  = mysqli_real_escape_string($mysqli, trim($_POST['jenis_bagan']));
                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel jenis bagan
                $query = mysqli_query($mysqli, "UPDATE jenis_bagan SET jenis_bagan    = '$jenis_bagan',
                                                                     updated_user   = '$updated_user'
                                                               WHERE id_jenis_bagan      = '$id_jenis_bagan'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=jenis_bagan&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $id_jenis_bagan = $_GET['id'];

            // perintah query untuk menghapus data pada tabel jenis bagan
            $query = mysqli_query($mysqli, "DELETE FROM jenis_bagan WHERE id_jenis_bagan='$id_jenis_bagan'")
                or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=jenis_bagan&alert=3");
            }
        }
    }
}

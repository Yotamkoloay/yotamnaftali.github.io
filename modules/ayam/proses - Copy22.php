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
            $id_ayam    = mysqli_real_escape_string($mysqli, trim($_POST['id_ayam']));
            $kategori  = mysqli_real_escape_string($mysqli, trim($_POST['kategori']));
            $nama_ayam  = mysqli_real_escape_string($mysqli, trim($_POST['nama_ayam']));
            $harga  = mysqli_real_escape_string($mysqli, trim($_POST['harga']));
            $keterangan  = mysqli_real_escape_string($mysqli, trim($_POST['keterangan']));
            $foto  = mysqli_real_escape_string($mysqli, trim($_POST['foto']));
            $created_user = $_SESSION['id_user'];

            $nama_file          = $_FILES['foto']['name'];
            $ukuran_file        = $_FILES['foto']['size'];
            $tipe_file          = $_FILES['foto']['type'];
            $tmp_file           = $_FILES['foto']['tmp_name'];

            // tentuka extension yang diperbolehkan
            $allowed_extensions = array('jpg', 'jpeg', 'png');

            // Set path folder tempat menyimpan gambarnya
            $path_file          = "../../assets/img/ayam/" . $nama_file;

            // check extension
            $file               = explode(".", $nama_file);
            $extension          = array_pop($file);

            if (empty($_FILES['foto']['name'])) {
                // perintah query untuk menyimpan data ke tabel Penilaian
                $query = mysqli_query($mysqli, "INSERT INTO ayam(id_ayam,id_kategori,nama_ayam,harga,keterangan,created_user,updated_user) 
                                            VALUES('$id_ayam','$kategori','$nama_ayam','$harga','$keterangan','$created_user','$created_user')")
                    or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=ayam&alert=1");
                }
            } else {
                // Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
                if (in_array($extension, $allowed_extensions)) {
                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
                    if ($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
                        // Proses upload
                        if (move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                            // Jika gambar berhasil diupload, Lakukan : 
                            // perintah query untuk mengubah data pada tabel ayam
                            $query = mysqli_query($mysqli, "INSERT INTO ayam Values
                                                                            id_ayam 		= '$id_ayam',
                                                                            nama_ayam 	= '$nama_ayam',
                                                                            harga 			= '$harga',
                                                                            keterangan		= '$keterangan',     
                                                                            foto 			= '$nama_file',
                                                                            created_user    = '$created_user'
                                                                          WHERE id_ayam 	= '$id_ayam'")
                                or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                            // cek query
                            if ($query) {
                                // jika berhasil tampilkan pesan berhasil update data
                                header("location: ../../main.php?module=ayam&alert=1");
                            }
                        } else {
                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
                            header("location: ../../main.php?module=ayam&alert=3");
                        }
                    } else {
                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
                        header(
                            "location: ../../main.php?module=ayam&alert=2"
                        );
                    }
                } else {
                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
                    header("location: ../../main.php?module=ayam&alert=4");
                }
            }
        }
        // --------------------


        // -------------------
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_data'])) {
                // ambil data hasil submit dari form
                $id_ayam    = mysqli_real_escape_string($mysqli, trim($_POST['sekolah']));
                $asal  = mysqli_real_escape_string($mysqli, trim($_POST['Asal_Propinsi']));
                $id_kota     = mysqli_real_escape_string($mysqli, trim($_POST['kota']));
                $nilai_un    = mysqli_real_escape_string($mysqli, trim($_POST['Nilai_UN']));
                $nilai_ijazah    = mysqli_real_escape_string($mysqli, trim($_POST['Nilai_Ijazah']));
                $prestasi    = mysqli_real_escape_string($mysqli, trim($_POST['Memiliki_prestasi_sekolah']));
                $pres_lain    = mysqli_real_escape_string($mysqli, trim($_POST['Pres_lain']));
                $info    = mysqli_real_escape_string($mysqli, trim($_POST['Info_ttg_Unsrat']));
                $info_lain    = mysqli_real_escape_string($mysqli, trim($_POST['Info_unsrat5']));
                $alasan    = mysqli_real_escape_string($mysqli, trim($_POST['Alasan_Masuk_Unsrat']));
                $alasan_lain    = mysqli_real_escape_string($mysqli, trim($_POST['Alasan_5']));
                $jalur_masuk    = mysqli_real_escape_string($mysqli, trim($_POST['Jalur_Masuk']));
                $fakultas    = mysqli_real_escape_string($mysqli, trim($_POST['Fakultas']));
                $program_studi    = mysqli_real_escape_string($mysqli, trim($_POST['Program_Studi']));
                $pilihan    = mysqli_real_escape_string($mysqli, trim($_POST['Pilihan_ke']));
                $ip    = mysqli_real_escape_string($mysqli, trim($_POST['IP_Semester1']));
                $persepsi    = mysqli_real_escape_string($mysqli, trim($_POST['Persepsi_Kualitas']));
                $pendidikan_ayah    = mysqli_real_escape_string($mysqli, trim($_POST['Pendidikan_Ayah']));
                $pendidikan_ibu    = mysqli_real_escape_string($mysqli, trim($_POST['Pendidikan_Ibu']));
                $pekerjaan_Ayah    = mysqli_real_escape_string($mysqli, trim($_POST['Pekerjaan_Ayah']));
                $pekerjaan_ibu    = mysqli_real_escape_string($mysqli, trim($_POST['Pekerjaan_Ibu']));
                $penghasilan    = mysqli_real_escape_string($mysqli, trim($_POST['Penghasilan_Orangtua']));

                // perintah query untuk mengubah data pada tabel Penilaian
                $query = mysqli_query($mysqli, "UPDATE datamahasiswa SET sekolah    = '$id_sekolah',
                                                                     Asal_Propinsi       = '$asal',
                                                                     kota      = '$id_kota',
                                                                     Nilai_UN   =  '$nilai_un',
                                                                     Nilai_Ijazah          =  '$nilai_ijazah',
                                                                     Memiliki_Prestasi_Sekolah   =   '$prestasi',
                                                                     Pres_lain   =   '$pres_lain',
                                                                     Info_ttg_Unsrat   =   '$info',
                                                                     Info_unsrat5   =   '$info_lain',
                                                                     Alasan_Masuk_Unsrat   =   '$alasan',
                                                                     Alasan_5   =   '$alasan_lain',
                                                                     Jalur_Masuk   =   '$jalur_masuk',
                                                                     Fakultas   =   '$fakultas',
                                                                     Program_Studi   =   '$program_studi',
                                                                     Pilihan_ke   =   '$pilihan',
                                                                     IP_Semester1   =   '$ip',
                                                                     Persepsi_Kualitas   =   '$persepsi',
                                                                     Pendidikan_ayah   =   '$pendidikan_ayah',
                                                                     Pendidikan_ibu     =   '$pendidikan_ibu',
                                                                     Pekerjaan_ayah     =   '$pekerjaan_ayah',
                                                                     Pekerjaan_ibu      =   '$pekerjaan_ibu',
                                                                     Penghasilan_Orangtua   =   '$penghasilan',
                                                               WHERE id_data      = '$id_data'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=mahasiswa&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $id_data = $_GET['id'];

            // perintah query untuk menghapus data pada tabel Penilaian
            $query = mysqli_query($mysqli, "DELETE FROM datamahasiswa WHERE id_data='$id_data'")
                or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=mahasiswa&alert=3");
            }
        }
    }
}

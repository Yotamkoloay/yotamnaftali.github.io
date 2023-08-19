<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert dan update
else {
	// insert data
	if ($_GET['act'] == 'insert') {
		if (isset($_POST['simpan'])) {
			// ambil data hasil submit dari form
			$username  = mysqli_real_escape_string($mysqli, trim($_POST['username']));
			$password  = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
			$hak_akses = mysqli_real_escape_string($mysqli, trim($_POST['hak_akses']));
			$profil  = mysqli_real_escape_string($mysqli, trim($_POST['profil']));

			// perintah query untuk menyimpan data ke tabel users
			$query = mysqli_query($mysqli, "INSERT INTO users(username,password,id_profil,hak_akses)
                                            VALUES('$username','$password','$profil','$hak_akses')")
				or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

			// cek query
			if ($query) {
				// jika berhasil tampilkan pesan berhasil simpan data
				header("location: ../../main.php?module=4dm1n&alert=1");
			}
		}
	}

	// update data
	elseif ($_GET['act'] == 'update') {
		if (isset($_POST['simpan'])) {
			if (isset($_POST['id_user'])) {
				// ambil data hasil submit dari form
				$id_user  = mysqli_real_escape_string($mysqli, trim($_POST['id_user']));
				$username  = mysqli_real_escape_string($mysqli, trim($_POST['username']));
				$profil  = mysqli_real_escape_string($mysqli, trim($_POST['profil']));
				$password  = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
				$hak_akses = mysqli_real_escape_string($mysqli, trim($_POST['hak_akses']));
				// perintah query untuk menyimpan data ke tabel users
			$query = mysqli_query($mysqli, "UPDATE users SET 
			id_user    = '$id_user',
			id_profil    = '$profil',
			username    = '$username',
			password   = '$password',
			hak_akses   = '$hak_akses'
WHERE id_user      = '$id_user'")
or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

// cek query
if ($query) {
// jika berhasil tampilkan pesan berhasil simpan data
header("location: ../../main.php?module=4dm1n&alert=1");

				}
			}
		}
	}

	// update status menjadi aktif
	elseif ($_GET['act'] == 'on') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$id_user = $_GET['id'];
			$status  = "aktif";

			// perintah query untuk mengubah data pada tabel users
			$query = mysqli_query($mysqli, "UPDATE users SET status  = '$status'
                                                          WHERE id_user = '$id_user'")
				or die('Ada kesalahan pada query update status on : ' . mysqli_error($mysqli));

			// cek query
			if ($query) {
				// jika berhasil tampilkan pesan berhasil update data
				header("location: ../../main.php?module=4dm1n&alert=3");
			}
		}
	}

	// update status menjadi blokir
	elseif ($_GET['act'] == 'off') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$id_user = $_GET['id'];
			$status  = "blokir";

			// perintah query untuk mengubah data pada tabel users
			$query = mysqli_query($mysqli, "UPDATE users SET status  = '$status'
                                                          WHERE id_user = '$id_user'")
				or die('Ada kesalahan pada query update status on : ' . mysqli_error($mysqli));

			// cek query
			if ($query) {
				// jika berhasil tampilkan pesan berhasil update data
				header("location: ../../main.php?module=4dm1n&alert=4");
			}
		}
	}
}

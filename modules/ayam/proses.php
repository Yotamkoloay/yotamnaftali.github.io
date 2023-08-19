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
			$satuan  = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));
			$harga = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga'])));
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
				$query = mysqli_query($mysqli, "INSERT INTO ayam(id_ayam,id_kategori,id_satuan,harga,keterangan,created_user,updated_user) 
                                            VALUES('$id_ayam','$kategori','$id_satuan','$harga','$keterangan','$created_user','$created_user')")
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
							$query = mysqli_query($mysqli, "INSERT INTO ayam(id_ayam,id_kategori,id_satuan,harga,foto,keterangan,created_user,updated_user) 
							VALUES('$id_ayam','$kategori','$satuan','$harga','$nama_file','$keterangan','$created_user','$created_user')")
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

			// ambil data hasil submit dari form
			$id_ayam    = mysqli_real_escape_string($mysqli, trim($_POST['id_ayam']));
			$kategori  = mysqli_real_escape_string($mysqli, trim($_POST['kategori']));
			$satuan  = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));
			$harga = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga'])));
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
						$query = mysqli_query($mysqli, "UPDATE ayam SET
                    															id_ayam 			= '$id_ayam',
																				id_kategori 			= '$kategori',
																				id_satuan 				= '$satuan',
																				harga		 		= '$harga',     
                    															keterangan 			= '$keterangan'
			                                                                  WHERE id_ayam 		= '$id_ayam'")
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
							$query = mysqli_query($mysqli, "UPDATE ayam SET
                    															id_ayam 			= '$id_ayam',
																				id_kategori 			= '$kategori',
																				id_satuan 				= '$satuan',
																				foto			='$nama_file',
																				harga		 	= '$harga',     
                    															keterangan 			= '$keterangan'
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
	} elseif ($_GET['act'] == 'delete') {
		if (isset($_GET['id'])) {
			$id_ayam = $_GET['id'];

			// perintah query untuk menghapus ayam pada tabel Penilaian
			$query = mysqli_query($mysqli, "DELETE FROM ayam WHERE id_ayam='$id_ayam'")
				or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

			// cek hasil query
			if ($query) {
				// jika berhasil tampilkan pesan berhasil delete ayam
				header("location: ../../main.php?module=ayam&alert=5");
			}
		}
	}
}

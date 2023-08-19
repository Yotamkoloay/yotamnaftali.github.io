<?php
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";
/* panggil file fungsi tambahan */
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan message = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=login.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih home, panggil file view home
	if ($_GET['module'] == 'home') {
		include "modules/beranda/view.php";
	}

	// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
	elseif ($_GET['module'] == 'ayam') {
		include "modules/ayam/view.php";
	}


	// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
	elseif ($_GET['module'] == 'form_ayam') {
		include "modules/ayam/form.php";
	}
	// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
	elseif ($_GET['module'] == 'ayam_masuk') {
		include "modules/ayam-masuk/view.php";
	}


	// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
	elseif ($_GET['module'] == 'form_ayam_masuk') {
		include "modules/ayam-masuk/form.php";
	}

		// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
		elseif ($_GET['module'] == 'ayam_keluar') {
			include "modules/ayam-keluar/view.php";
		}
	
	
		// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
		elseif ($_GET['module'] == 'form_ayam_keluar') {
			include "modules/ayam-keluar/form.php";
		}		
		// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
		elseif ($_GET['module'] == 'laporan') {
			include "modules/laporan/view.php";
		}
	
	
		// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
		elseif ($_GET['module'] == 'laporan') {
			include "modules/laporan/form.php";
		}

	// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
	elseif ($_GET['module'] == 'Manajemen User') {
		include "modules/kota/view.php";
	}

	// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
	elseif ($_GET['module'] == 'kategori') {
		include "modules/kategori/view.php";
	}
// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
elseif ($_GET['module'] == 'form_kategori') {
	include "modules/kategori/form.php";
}
		// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
		elseif ($_GET['module'] == 'satuan') {
			include "modules/satuan/view.php";
		}
	// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
	elseif ($_GET['module'] == 'form_satuan') {
		include "modules/satuan/form.php";
	}

			// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
			elseif ($_GET['module'] == 'm-profil') {
				include "modules/m-profil/view.php";
			}
		// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
		elseif ($_GET['module'] == 'form_m-profil') {
			include "modules/m-profil/form.php";
		}

	// jika halaman konten yang dipilih kedokteran, panggil file view kedokteran
	elseif ($_GET['module'] == 'form_admin') {
		include "modules/user/form_admin.php";
	}


	// jika halaman konten yang dipilih user, panggil file view user


	elseif ($_GET['module'] == '4dm1n') {
		include "modules/user/view_admin.php";
	}


	// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
	elseif ($_GET['module'] == 'form_mahasiswa') {
		include "modules/mahasiswa/form.php";
	}

	// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
	elseif ($_GET['module'] == 'profil') {
		include "modules/profil/view.php";
	}

	// jika halaman konten yang dipilih form penilaian, panggil file form penilaian
	elseif ($_GET['module'] == 'form_mahasiswa') {
		include "modules/mahasiswa/form.php";
	}

	

	// jika halaman konten yang dipilih form profil, panggil file form profil
	elseif ($_GET['module'] == 'form_profil') {
		include "modules/profil/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
}

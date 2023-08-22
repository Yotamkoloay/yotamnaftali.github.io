

<?php
// fungsi pengecekan level untuk menampilkan menu sesuai dengan hak akses
// jika hak akses = Admin, tampilkan menu
if ($_SESSION['hak_akses'] == 'Admin') { ?>
	<!-- sidebar menu start -->
	<ul class="sidebar-menu">
		<li class="header">MAIN MENU</li>

		<?php
		// fungsi untuk pengecekan menu aktif
		// jika menu home dipilih, menu home aktif
		if ($_GET["module"] == "home") { ?>
			<li class="active">
				<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
			</li>
		<?php
		}
		// jika tidak, menu home tidak aktif
		else { ?>
			<li>
				<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
			</li>
			<?php
		}

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "laporan") { ?>
			<li class="active">
				<a href="?module=laporan"><i class="fa fa-folder"></i> Laporan Ayam</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=laporan"><i class="fa fa-folder"></i> Laporan Ayam</a>
			</li>
		
			<?php
	}

	// jika menu Barang Masuk dipilih, menu Barang Masuk aktif
	if ($_GET["module"]=="m-profil" || $_GET["module"]=="form_m-profil") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-clone"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=m-profil"><i class="fa fa-folder"></i> Profil User</a></li>
				<li><a href="?module=4dm1n"><i class="fa fa-user"></i> Manajemen User</a></li>
      		</ul>
		</li>
	<?php
	}
	// jika menu Barang Keluar dipilih, menu Barang Keluar aktif
	elseif ($_GET["module"]=="4dm1n" || $_GET["module"]=="form_admin") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-clone"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=m-profil"><i class="fa fa-folder"></i> Profil User</a></li>
				<li class="active"><a href="?module=4dm1n"><i class="fa fa-user"></i> Manajemen User</a></li>
      		</ul>
		</li>
	
    <?php
	}
	// jika menu User tidak dipilih, menu User tidak aktif
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-clone"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=m-profil"><i class="fa fa-folder"></i> Profil User</a></li>
        		<li><a href="?module=4dm1n"><i class="fa fa-user"></i> Manajemen User</a></li>
      		</ul>
    	</li>

		<?php
		}



		// jika menu ubah password dipilih, menu ubah password aktif
		if ($_GET["module"] == "password") { ?>
			<li class="active">
				<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah password tidak aktif
		else { ?>
			<li>
				<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
			</li>
		<?php
		}
		?>
	</ul>
	<!--sidebar menu end-->
	<!--sidebar menu end-->

	<?php
}
// jika hak akses = User, tampilkan menu
if ($_SESSION['hak_akses'] == 'Penjual') { ?>
	<!-- sidebar menu start -->
	<ul class="sidebar-menu">
		<li class="header">MAIN MENU</li>

		<?php
		// fungsi untuk pengecekan menu aktif
		// jika menu home dipilih, menu home aktif
		if ($_GET["module"] == "home") { ?>
			<li class="active">
				<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
			</li>
		<?php
		}
		// jika tidak, menu home tidak aktif
		else { ?>
			<li>
				<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
			</li>

		<?php
		}

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "ayam") { ?>
			<li class="active">
				<a href="?module=ayam"><i class="fa fa-folder"></i> Update Ayam</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=ayam"><i class="fa fa-folder"></i> Update Ayam</a>
			</li>



		<?php
		}

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "kategori") { ?>
			<li class="active">
				<a href="?module=kategori"><i class="fa fa-folder"></i> Kategori</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=kategori"><i class="fa fa-folder"></i> Kategori</a>
			</li>

			
<?php
		}

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "satuan") { ?>
			<li class="active">
				<a href="?module=satuan"><i class="fa fa-folder"></i> Satuan</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=satuan"><i class="fa fa-folder"></i> Satuan</a>
			</li>

			<?php
		}

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "ayam_masuk") { ?>
			<li class="active">
				<a href="?module=ayam_masuk"><i class="fa fa-folder"></i> Update Ayam Masuk</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=ayam_masuk"><i class="fa fa-folder"></i> Update Ayam Masuk</a>
			</li>
			<?php
		}

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "ayam_keluar") { ?>
			<li class="active">
				<a href="?module=ayam_keluar"><i class="fa fa-folder"></i> Pembelian Ayam</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=ayam_keluar"><i class="fa fa-folder"></i> Pembelian Ayam</a>
			</li>
		<?php
		}

		

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "profil") { ?>
			<li class="active">
				<a href="?module=profil"><i class="fa fa-folder"></i> Profil</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=profil"><i class="fa fa-folder"></i> Profil</a>
			</li>


		
		<?php
		}



		// jika menu ubah password dipilih, menu ubah password aktif
		if ($_GET["module"] == "password") { ?>
			<li class="active">
				<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah password tidak aktif
		else { ?>
			<li>
				<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
			</li>
			
		<?php
		}
		?>
	</ul>
	<!--sidebar menu end-->

	<?php
}
// jika hak akses = User, tampilkan menu
if ($_SESSION['hak_akses'] == 'Pembeli') { ?>
	<!-- sidebar menu start -->
	<ul class="sidebar-menu">
		<li class="header">MAIN MENU</li>

		<?php
		// fungsi untuk pengecekan menu aktif
		// jika menu home dipilih, menu home aktif
		if ($_GET["module"] == "home") { ?>
			<li class="active">
				<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
			</li>
		<?php
		}
		// jika tidak, menu home tidak aktif
		else { ?>
			<li>
				<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
			</li>

			<?php
		}

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "ayam_keluar") { ?>
			<li class="active">
				<a href="?module=ayam_keluar"><i class="fa fa-folder"></i> Pembelian Ayam</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=ayam_keluar"><i class="fa fa-folder"></i> Pembelian Ayam</a>
			</li>
		<?php
		}

		

		// jika menu ubah penilaian dipilih, menu ubah penilaian aktif
		if ($_GET["module"] == "profil") { ?>
			<li class="active">
				<a href="?module=profil"><i class="fa fa-folder"></i> Profil</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah penilaian tidak aktif
		else { ?>
			<li>
				<a href="?module=profil"><i class="fa fa-folder"></i> Profil</a>
			</li>


		
		<?php
		}



		// jika menu ubah password dipilih, menu ubah password aktif
		if ($_GET["module"] == "password") { ?>
			<li class="active">
				<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
			</li>
		<?php
		}
		// jika tidak, menu ubah password tidak aktif
		else { ?>
			<li>
				<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
			</li>
			
		<?php
		}
		?>
	</ul>
	<!--sidebar menu end-->

<?php
}
?>


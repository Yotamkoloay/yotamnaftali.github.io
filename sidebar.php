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
    // jika menu user dipilih, menu user aktif
    if ($_GET["module"] == "4dm1n" || $_GET["module"] == "form_admin") { ?>
        <li class="active">
            <a href="?module=4dm1n"><i class="fa fa-user"></i> Manajemen User</a>
        </li>
    <?php
    }
    // jika tidak, menu user tidak aktif
    else { ?>
        <li>
            <a href="?module=4dm1n"><i class="fa fa-user"></i> Manajemen User</a>
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
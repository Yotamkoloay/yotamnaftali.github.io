<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $id_ayam_keluar = mysqli_real_escape_string($mysqli, trim($_POST['id_ayam_keluar']));
            $harga = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga'])));
            
            $tanggal          = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
            $exp              = explode('-',$tanggal);
            $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
            $id_ayam        = mysqli_real_escape_string($mysqli, trim($_POST['id_ayam']));
            $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
            $total_stok       = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));
            
            $created_user     = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel ayam keluar
            $query = mysqli_query($mysqli, "INSERT INTO ayam_keluar(id_ayam_keluar,harga,tanggal_keluar,id_ayam,jumlah_keluar,created_user) 
                                            VALUES('$id_ayam_keluar','$harga','$tanggal_keluar','$id_ayam','$jumlah_keluar','$created_user')
                                            ")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {                      
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=ayam_keluar&alert=1");
            }   
        }   
    }
    elseif ($_GET['act'] == 'choosen') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $id_keluar = mysqli_real_escape_string($mysqli, trim($_POST['id_keluar']));

            $tanggal          = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
            $exp              = explode('-', $tanggal);
            $tanggal_keluar   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];
            $id_tangkapan     = mysqli_real_escape_string($mysqli, trim($_POST['id_tangkapan']));
            $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
            $total_stok       = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));
            $total_harga       = mysqli_real_escape_string($mysqli, trim($_POST['total_harga']));

            $created_user     = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel tangkapan keluar
            $query = mysqli_query($mysqli, "INSERT INTO keluar(id_keluar,tanggal_keluar,id_tangkapan,jumlah_keluar,created_user) 
                                            VALUES('$id_keluar','$tanggal_keluar','$id_tangkapan','$jumlah_keluar','$created_user')
                                            ")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=keluar&alert=1");
            }
        }
    }
    elseif ($_GET['act']=='cetak') {
           
                if (isset($_POST['id_ayam_keluar'])) {
                // ambil data hasil submit dari form
                $id_ayam_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['id_ayam_keluar']));
                $username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
                $nip           = mysqli_real_escape_string($mysqli, trim($_POST['NIP']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
    
                
    
                // perintah query untuk menyimpan data ke tabel ayam
                $query = mysqli_query($mysqli, " UPDATE ayam_keluar SET  
                                                                              jumlah_keluar    = '$jumlah_keluar'
                                                                        WHERE id_ayam_keluar = '$id_ayam_keluar'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));    
    
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=ayam_keluar&alert=4");
                }   
            }   
                
    }
    elseif ($_GET['act']=='update') {
            if (isset($_POST['simpan'])) {
                if (isset($_POST['id_ayam_keluar'])) {
                // ambil data hasil submit dari form
                $id_ayam_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['id_ayam_keluar']));
                $username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
                $nip           = mysqli_real_escape_string($mysqli, trim($_POST['NIP']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
    
                
    
                // perintah query untuk menyimpan data ke tabel ayam
                $query = mysqli_query($mysqli, " UPDATE ayam_keluar SET  
                                                                              jumlah_keluar    = '$jumlah_keluar'
                                                                        WHERE id_ayam_keluar = '$id_ayam_keluar'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));    
    
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=ayam_keluar&alert=4");
                }   
            }   
        }           
    }
      elseif ($_GET['act']=='print') {
            if (isset($_POST['simpan'])) {
                if (isset($_POST['id_ayam_keluar'])) {
                // ambil data hasil submit dari form
                $id_ayam_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['id_ayam_keluar']));
                $username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
                $nip           = mysqli_real_escape_string($mysqli, trim($_POST['NIP']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
    
                
    
                // perintah query untuk menyimpan data ke tabel ayam
                $query = mysqli_query($mysqli, " UPDATE ayam_keluar SET  
                                                                              jumlah_keluar    = '$jumlah_keluar'
                                                                        WHERE id_ayam_keluar = '$id_ayam_keluar'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));    
    
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=ayam_keluar&alert=4");
                }   
            }   
        }           
    }
    elseif ($_GET['act']=='approve') {
        if (isset($_GET['id'])) {
            // ambil data hasil submit dari form
            $id_ayam_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
            $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_GET['jml']));
            $id_ayam        = mysqli_real_escape_string($mysqli, trim($_GET['idb']));

            $stok             = mysqli_real_escape_string($mysqli, trim($_GET['stok']));
            $status           = "Approve";
            $sisa_stok        = $stok - $jumlah_keluar;

            // perintah query untuk mengubah data pada tabel ayam
            $query = mysqli_query($mysqli, "UPDATE ayam_keluar SET status              = '$status'
                                                                  WHERE id_ayam_keluar    = '$id_ayam_keluar'")
                                            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

            // cek query
            if ($query) {
                // perintah query untuk mengubah data pada tabel ayam
                $query1 = mysqli_query($mysqli, "UPDATE ayam SET stok      = '$sisa_stok'
                                                                WHERE id_ayam = '$id_ayam'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query1) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=ayam_keluar&alert=2");
                }
            }     
        }   
    }

    elseif ($_GET['act']=='reject') {
        if (isset($_GET['id'])) {
            // ambil data hasil submit dari form
            $id_ayam_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
            $status           = "Reject";

            // perintah query untuk mengubah data pada tabel ayam
            $query = mysqli_query($mysqli, "UPDATE ayam_keluar SET status              = '$status'
                                                                  WHERE id_ayam_keluar    = '$id_ayam_keluar'")
                                            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

            // cek query
            if ($query) {                  
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=ayam_keluar&alert=3");
            }     
        }   
    }
}     
  
?>
<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";

$hari_ini = date("d-m-Y");
if (isset($_GET['id'])) {
$no = 1;
// fungsi query untuk menampilkan data dari tabel transaksi
  $query = mysqli_query($mysqli, "SELECT a.id_barang_keluar,a.tanggal_keluar,a.id_barang,a.id_tim,a.jumlah_keluar,a.created_user,a.status,b.id_barang,b.nama_barang,b.id_satuan,b.created_user,c.id_satuan,c.nama_satuan,d.username,d.id_user,d.NIP,e.id_tim,e.nama_tim
                                    FROM is_barang_keluar as a INNER JOIN is_barang as b INNER JOIN is_satuan as c INNER JOIN is_users as d INNER JOIN is_tim as e 
                                    ON a.id_barang=b.id_barang AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user AND a.id_tim=e.id_tim 
                                    WHERE a.created_user='$_GET[id]' AND a.id_tim='$_GET[tim]'  AND a.tanggal_keluar='$_GET[tgl]' AND a.status='Approve'
                                    ORDER BY a.id_barang_keluar ASC") 
                                    or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Bukti Permintaan Barang</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" />
           <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        
        <div id="title">
            FORM PERMINTAAN BARANG KOMINFO
        </div>
        
        <hr>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tbody>
			<tr>
                <td>
                    <br>Nama                : <?php echo ("$_GET[nl]");?>
                    <br>NIP                 : <?php echo ("$_GET[np]");?>
                    <br>TIM                 : <?php echo ("$_GET[nt]");?>
                    <br>Keperluan           :........................
                    <br>Jenis Permintaan    :
                </td>
			</tr>
		</tbody></table>
        <div id="isi">
            <table width="100%" border="0.4" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">ID Permintaan</th>
                        <th height="20" align="center" valign="middle">PENGGUNA</th>
                        <th height="20" align="center" valign="middle">TIM</th>
                        <th height="20" align="center" valign="middle">NAMA BARANG</th>
                        <th height="20" align="center" valign="middle">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
    if($count == 0) {
        echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='210' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='100' height='13' align='center' valign='middle'></td>
                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
            $id_permintaan       = $data['id_barang_keluar'];
          

            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='120' height='13' align='center' valign='middle'>$id_permintaan</td>
                        <td width='120' height='13' align='center' valign='middle'>$data[username]</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[nama_tim]</td>
                        <td style='padding-left:5px;' width='210' height='13' align='center' valign='middle'>$data[nama_barang]</td>
                        <td style='padding-left:5px;' width='100' height='13' align='center' valign='middle'>$data[jumlah_keluar] $data[nama_satuan]</td>
                    </tr>";
            $no++;
        }
    }
        ?>  
                </tbody>
            </table>
            <br>
            <div>
		<table width="100%" cellpadding="15%" cellspacing="15%" border="">
			<tbody><tr> 
                <td width="50%">Mengetahui, <br> 
                                Petugas (<?php echo ("$_SESSION[hak_akses]"); ?>) <br> <br> <br> <br> <br> <br> 
                                <?php echo ("$_SESSION[nama_user]");?><br>NIP.<?php echo ("$_SESSION[NIP]");?> </td>
				<td width="15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td width="60%"></td>
                <td width="15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                
                <td width="50%">Manado, <?php echo tgl_eng_to_ind("$hari_ini");?> <br>
                                Penerima <br><br><br><br><br><br>
                                <?php echo ("$_GET[nama]"); ?><br>NIP.<?php echo ("$_GET[np]");?></td>
			</tr>
	
		</tbody></table><br>
		
		</div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="Bukti Permintaan Barang $_GET[nama] $hari_ini.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
// panggil library html2pdf
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('L','A5','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>
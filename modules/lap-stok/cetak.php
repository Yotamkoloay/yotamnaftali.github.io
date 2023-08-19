<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";

$hari_ini = date("d-m-Y");

$no = 1;
// fungsi query untuk menampilkan data dari tabel transaksi
$query = mysqli_query($mysqli, "SELECT a.id_tangkapan,a.nama_tangkapan,a.id_jenis,a.id_satuan,a.stok,b.id_jenis,b.nama_jenis,c.id_satuan,c.nama_satuan 
                                FROM tangkapan as a INNER JOIN jenis_tangkapan as b INNER JOIN satuan as c
                                ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan ORDER BY id_tangkapan DESC")
    or die('Ada kesalahan pada query tampil Data Tangkapan: ' . mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Laporan Stok Tangkapan</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" />
</head>

<body>
    <div id="title">
        LAPORAN STOK Tangkapan Bagan
    </div>

    <hr><br>

    <div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">No.</th>

                    <th height="20" align="center" valign="middle">Nama Tangkapan</th>
                    <th height="20" align="center" valign="middle">Jenis Tangkapan</th>
                    <th height="20" align="center" valign="middle">Stok</th>
                    <th height="20" align="center" valign="middle">Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                     
                        <td style='padding-left:5px;' width='215' height='13' valign='middle'>$data[nama_tangkapan]</td>
                        <td style='padding-left:5px;' width='150' height='13' valign='middle'>$data[nama_jenis]</td>
                        <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'>$data[stok]</td>
                        <td style='padding-left:5px;' width='80' height='13' valign='middle'>$data[nama_satuan]</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <div id="footer-tanggal">
            Manado, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
        </div>
        <div id="footer-jabatan">
            Petugas <?php echo ("$_SESSION[hak_akses]"); ?>
        </div>

        <div id="footer-nama">
            <?php echo ("$_SESSION[username]"); ?>
        </div>
    </div>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename = "LAPORAN STOK TANGKAPAN BAGAN.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';
// panggil library html2pdf
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'F4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?>
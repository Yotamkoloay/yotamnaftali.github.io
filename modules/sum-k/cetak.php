<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";

$hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
$tgl1     = $_GET['tgl_awal'];
$explode  = explode('-', $tgl1);
$tgl_awal = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-', $tgl2);
$tgl_akhir = $explode[2] . "-" . $explode[1] . "-" . $explode[0];



if (isset($_GET['tgl_awal'])) {
    $no    = 1;
    // fungsi query untuk menampilkan data dari tabel tangkapan keluar
    $query = mysqli_query($mysqli, "SELECT a.id_keluar,a.tanggal_keluar,a.id_tangkapan,sum(a.jumlah_keluar),a.created_user,a.status,b.id_tangkapan,b.nama_tangkapan,b.id_satuan,b.created_user,c.id_satuan,c.nama_satuan,d.username,d.id_user
                                    FROM keluar as a INNER JOIN tangkapan as b INNER JOIN satuan as c INNER JOIN users as d 
                                    ON a.id_tangkapan=b.id_tangkapan AND b.id_satuan=c.id_satuan AND a.created_user=d.id_user  
                                    WHERE d.id_user='$_SESSION[id_user]' AND  a.tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' AND a.status='Approve'
                                    GROUP BY b.nama_tangkapan ASC")
        or die('Ada kesalahan pada query tampil Transaksi : ' . mysqli_error($mysqli));
    $count  = mysqli_num_rows($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN TOTAL PENGELUARAN</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" />
</head>

<body>
    <div id="title">
        LAPORAN TOTAL PENGELUARAN
    </div>
    <?php
    if ($tgl_awal == $tgl_akhir) { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
        </div>
    <?php
    } else { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. <?php echo tgl_eng_to_ind($tgl2); ?>
        </div>
    <?php
    }
    ?>

    <hr><br>
    <div id="isi">
        <table align='center' width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">NAMA TANGKAPAN</th>
                    <th height="20" align="center" valign="middle">TOTAL KELUAR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // jika data ada
                if ($count == 0) {
                    echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='210' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='100' height='13' align='center' valign='middle'></td>
                </tr>";
                }
                // jika data tidak ada
                else {
                    // tampilkan data
                    while ($data = mysqli_fetch_assoc($query)) {
                        $sum           = $data['sum(a.jumlah_keluar)'];
                        $tanggal       = $data['tanggal_keluar'];
                        $exp           = explode('-', $tanggal);
                        $tanggal_keluar = tgl_eng_to_ind($exp[2] . "-" . $exp[1] . "-" . $exp[0]);
                        $pembulatan     = round($sum, 3);
                        // menampilkan isi tabel dari database ke tabel di aplikasi
                        echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td style='padding-left:5px;' width='210' height='13' valign='middle'>$data[nama_tangkapan]</td>
                        <td style='padding-left:5px;' width='100' height='13' valign='middle'>$pembulatan $data[nama_satuan]</td>
                    </tr>";
                        $no++;
                    }
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
$filename = "Total PENGELUARAN TANGGAL ($tgl1) S.D ($tgl2).pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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
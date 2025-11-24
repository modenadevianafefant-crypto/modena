<?php 
include '../koneksi.php';

// cek parameter
if(!isset($_GET['dari']) || !isset($_GET['sampai'])){
    echo "Parameter tanggal tidak ditemukan!";
    exit;
}

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
</head>
<body>

<center>
    <h2>LAPORAN LAUNDRY</h2>
    <h4>Periode : <b><?php echo $dari; ?></b> s/d <b><?php echo $sampai; ?></b></h4>
</center>

<br>

<table class="table table-bordered table-striped">
    <tr>
        <th width="1%">No</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Berat (kg)</th>
        <th>Tgl. Selesai</th>
        <th>Harga</th>
        <th>Status</th>
    </tr>

    <?php 
    $no = 1;
    $data = mysqli_query($koneksi, 
        "SELECT * FROM transaksi, pelanggan 
         WHERE transaksi.pelanggan_id = pelanggan.pelanggan_id
         AND transaksi_tgl BETWEEN '$dari' AND '$sampai'
         ORDER BY transaksi_id DESC");

    while($d = mysqli_fetch_array($data)){
    ?>

    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['transaksi_id']; ?></td>
        <td><?php echo $d['transaksi_tgl']; ?></td>
        <td><?php echo $d['pelanggan_nama']; ?></td>
        <td><?php echo $d['transaksi_berat']; ?></td>
        <td><?php echo $d['transaksi_tgl_selesai']; ?></td>
        <td><?php echo "Rp.".number_format($d['transaksi_harga']); ?></td>
        <td>
            <?php 
                if($d['transaksi_status']=="0"){
                    echo "PROSES";
                } elseif($d['transaksi_status']=="1"){
                    echo "DICUCI";
                } elseif($d['transaksi_status']=="2"){
                    echo "SELESAI";
                }
            ?>
        </td>
    </tr>

    <?php 
    } 
    ?>
</table>

<script>
    window.print();
</script>

</body>
</html>
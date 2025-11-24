<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Loundry</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
    <script type="text/javascript" src="../asset/js/jquery.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
</head>
<body>
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../index.php?pesan=belum_login");
    }
    include '../koneksi.php';
    ?>
    <div class="col-md-10 col-md-offset-1">
        <?php
        $id = $_GET['id'];
        $transaksi = mysqli_query($koneksi, "select * from transaksi, pelanggan where transaksi_id='$id' and transaksi.pelanggan_id = pelanggan.pelanggan_id");
        while ($t = mysqli_fetch_array($transaksi)) {
            ?>
        <center>
            <h2>Loundry RPL</h2>
        </center>
                <span class="glyphicon glyphicon-print"></span> Cetak
            </a>
            <br><br>
            <table class="table">
                <tr>
                    <th width="20%">No. Invoice</th>
                    <th>:</th>
                    <th>INVOICE-<?php echo $t['transaksi_id']; ?></th>
                </tr>
                <tr>
                    <th width="20%">Tgl Laundry</th>
                    <th>:</th>
                    <th><?php echo $t['transaksi_tgl']; ?></th>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>:</th>
                    <th><?php echo $t['pelanggan_nama']; ?></th>
                </tr>
                <tr>
                    <th>HP</th>
                    <th>:</th>
                    <th><?php echo $t['pelanggan_hp']; ?></th>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <th><?php echo $t['pelanggan_alamat']; ?></th>
                </tr>
                <tr>
                    <th>Berat Cucian</th>
                    <th>:</th>
                    <th><?php echo $t['transaksi_berat']; ?></th>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <th>:</th>
                    <th><?php echo $t['transaksi_tgl_selesai']; ?></th>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>:</th>
                    <th>
                        <?php
                        if ($t['transaksi_status'] == '0') {
                            echo "<div class='label label-warning'>PROSES</div>";
                        } elseif ($t['transaksi_status'] == '1') {
                            echo "<div class='label label-info'>DICUCI</div>";
                        } elseif ($t['transaksi_status'] == '2') {
                            echo "<div class='label label-success'>SELESAI</div>";
                        }
                        ?>
                    </th>
                </tr>
                <tr>
                    <th>Harga</th>
                    <th>:</th>
                    <th><?php echo "Rp." . number_format($t['transaksi_harga']); ?></th>
                </tr>
            </table>
            <br>
            <h4 class="text-center">Daftar Cucian</h4>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Jenis Pakaian</th>
                    <th width="20%">Jumlah</th>
                </tr>
                <?php
                $id = $t['transaksi_id'];
                $pakaian = mysqli_query($koneksi, "select * from pakaian where transaksi_id='$id'");
                while ($p = mysqli_fetch_array($pakaian)) {
                    ?>
                    <tr>
                        <td><?php echo $p['jenis_pakaian'] ?></td>
                        <td width="5%"><?php echo $p['jumlah_pakaian'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <br>
            <p><center><i>Terima Kasih atas Kepercayaan Anda</i></center></p>
            <?php
        }
        ?>
    </div>

    <script> type="text/javascript">
            window.print();
    </script>
</body>
</html>
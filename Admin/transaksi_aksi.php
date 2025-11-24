<?php
include '../koneksi.php';

$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tgl_selesai = $_POST['tgl_selesai'];
$tgl_hari_ini = date('Y-m-d');
$status = 0;

$h = mysqli_query($koneksi, "SELECT harga_per_kilo FROM harga");
if (!$h) {
    die("Error: " . mysqli_error($koneksi));
}
$harga_per_kilo = mysqli_fetch_assoc($h);
$harga = $berat * $harga_per_kilo['harga_per_kilo'];

$insert_transaksi = mysqli_query($koneksi, "INSERT INTO transaksi VALUES ('','$tgl_hari_ini','$pelanggan','$harga','$berat','$tgl_selesai','$status')");
if (!$insert_transaksi) {
    die("Error: " . mysqli_error($koneksi));
}

$id_terakhir = mysqli_insert_id($koneksi);

$jenis_pakaian = $_POST['jenis_pakaian'];
$jumlah_pakaian = $_POST['jumlah_pakaian'];

for ($x = 0; $x < count($jenis_pakaian); $x++) {
    if ($jenis_pakaian[$x] != "") {
        $insert_pakaian = mysqli_query($koneksi, "INSERT INTO pakaian VALUES ('','$id_terakhir','$jenis_pakaian[$x]','$jumlah_pakaian[$x]')");
        if (!$insert_pakaian) {
            die("Error: " . mysqli_error($koneksi));
        }
    }
}

echo "<script>alert('Transaksi akan ditambah?'); window.location.href='transaksi.php'</script>";
?>
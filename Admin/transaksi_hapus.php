<?php
include '../koneksi.php';
$id = $_GET['id'];
$pakaian_hapus = mysqli_query($koneksi, "delete from pakaian where transaksi_id='$id'");
$transaksi_hapus = mysqli_query($koneksi, "delete from transaksi where transaksi_id='$id'");
if ($pakaian_hapus && $transaksi_hapus) {
    echo "<script>alert('Data akan dihapus?'); window.location.href='transaksi.php'</script>";
} else {
    echo "<script>alert('Error: Data gagal dihapus!'); window.location.href='transaksi.php'</script>";
}
?>
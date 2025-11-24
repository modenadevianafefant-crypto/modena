<?php
include '../koneksi.php';
session_start();

$username = $_SESSION['username'];
$password_baru = md5($_POST['password_baru']);

$query = mysqli_query($koneksi, "UPDATE admin SET password='$password_baru' WHERE username='$username'");

if ($query) {
    header("location:ganti_password.php?pesan=berhasil");
} else {
    echo "<div class='alert alert-danger'>Gagal mengganti password.</div>";
}
?>
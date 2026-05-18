<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak!");
}

$id = $_GET['id'];

mysqli_query($conn,

"UPDATE pendaftaran

SET

status='selesai',
status_pembayaran='terverifikasi'

WHERE id='$id'"

);

header("Location: data_pendaftar.php");
exit;
?>
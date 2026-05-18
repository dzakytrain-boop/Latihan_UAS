<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak!");
}

$id = $_GET['id'];
$status = $_GET['status'];

/* LIST STATUS YANG VALID */
$allowed = [

    'verifikasi',
    'ujian',
    'menunggu_hasil',
    'lulus',
    'tidak_lulus'

];

if(!in_array($status, $allowed)){
    die("Status tidak valid!");
}

mysqli_query($conn,

"UPDATE pendaftaran

 SET status='$status'

 WHERE id='$id'"

);

header("Location: data_pendaftar.php");
exit;
?>
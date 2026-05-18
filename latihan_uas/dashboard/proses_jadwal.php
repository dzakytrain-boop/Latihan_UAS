<?php
include '../config/koneksi.php';

$id = $_POST['id'];
$lokasi = $_POST['lokasi_ujian'];
$tanggal = $_POST['tanggal_ujian'];

mysqli_query($conn,

"UPDATE pendaftaran

 SET

 lokasi_ujian='$lokasi',
 tanggal_ujian='$tanggal',
 status='ujian'

 WHERE id='$id'"

);

header("Location: data_pendaftar.php");
?>
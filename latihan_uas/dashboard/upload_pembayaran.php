<?php
session_start();
include '../config/koneksi.php';

$id = $_POST['id'];

$nama_file = $_FILES['bukti']['name'];
$tmp = $_FILES['bukti']['tmp_name'];

move_uploaded_file(
    $tmp,
    "../uploads/" . $nama_file
);

mysqli_query($conn,

"UPDATE pendaftaran

SET

bukti_pembayaran='$nama_file',
status='daftar_ulang',
status_pembayaran='menunggu'

WHERE id='$id'"

);

$_SESSION['success'] =
"Pembayaran berhasil diupload!";

header("Location: mahasiswa.php");
exit;
?>
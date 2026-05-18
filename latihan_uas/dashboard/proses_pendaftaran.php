<?php
session_start();
include '../config/koneksi.php';

$user_id = $_POST['user_id'];

$nisn = $_POST['nisn'];
$nik = $_POST['nik'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$asal_sekolah = $_POST['asal_sekolah'];
$jurusan_pilihan = $_POST['jurusan_pilihan'];

$query = mysqli_query($conn,

"INSERT INTO pendaftaran(

user_id,
nisn,
nik,
tempat_lahir,
tanggal_lahir,
jenis_kelamin,
alamat,
asal_sekolah,
jurusan_pilihan,
status

)

VALUES(

'$user_id',
'$nisn',
'$nik',
'$tempat_lahir',
'$tanggal_lahir',
'$jenis_kelamin',
'$alamat',
'$asal_sekolah',
'$jurusan_pilihan',
'menunggu'

)"

);

if ($query) {

    $_SESSION['success'] =
    "Pendaftaran berhasil dikirim!";

    header("Location: mahasiswa.php");
    exit;

} else {

    $_SESSION['error'] =
    "Pendaftaran gagal!";

    header("Location: form_pendaftaran.php");
    exit;

}
?>
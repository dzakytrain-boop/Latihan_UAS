<?php
session_start();
include '../config/koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$verifikasi = $_POST['verifikasi'];

/* VERIFIKASI HITUNGAN */
if ($verifikasi != $_SESSION['hasil']) {

    $_SESSION['error'] =
    "Jawaban verifikasi salah!";

    header("Location: register.php");
    exit;
}

/* CEK EMAIL */
$cek = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE email='$email'"
);

if (mysqli_num_rows($cek) > 0) {

    $_SESSION['error'] =
    "Email sudah digunakan!";

    header("Location: register.php");
    exit;
}

/* INSERT USER */
$query = mysqli_query(
    $conn,

    "INSERT INTO users(

        nama,
        email,
        password,
        role

    )

    VALUES(

        '$nama',
        '$email',
        '$password',
        'mahasiswa'

    )"
);

/* HASIL REGISTER */
if ($query) {

    $_SESSION['success'] =
    "Register berhasil, silakan login!";

    header("Location: login.php");
    exit;

} else {

    $_SESSION['error'] =
    "Register gagal!";

    header("Location: register.php");
    exit;
}
?>
<?php
session_start();
include '../config/koneksi.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE email='$email'
     AND password='$password'"
);

$data = mysqli_fetch_assoc($query);

if ($data) {

    $_SESSION['id'] = $data['id'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];

    if ($data['role'] == 'admin') {
        header("Location: ../dashboard/admin.php");
    } else {
        header("Location: ../dashboard/mahasiswa.php");
    }

} else {
    echo "Email atau password salah!";
}
?>
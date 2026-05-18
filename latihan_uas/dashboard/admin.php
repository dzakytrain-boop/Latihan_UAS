<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
}

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak!");
}

/* TOTAL PENDAFTAR */
$total_pendaftar = mysqli_num_rows(

    mysqli_query($conn,
    "SELECT * FROM pendaftaran")

);

/* TOTAL SUDAH DIVERIFIKASI */
$total_verifikasi = mysqli_num_rows(

    mysqli_query($conn,

    "SELECT * FROM pendaftaran
     WHERE status IN (
        'verifikasi',
        'ujian',
        'menunggu_hasil',
        'lulus',
        'daftar_ulang',
        'selesai'
     )")

);

/* TOTAL LULUS */
$total_lulus = mysqli_num_rows(

    mysqli_query($conn,

    "SELECT * FROM pendaftaran
     WHERE status IN (
        'lulus',
        'daftar_ulang',
        'selesai'
     )")

);

/* TOTAL TIDAK LULUS */
$total_tidak_lulus = mysqli_num_rows(

    mysqli_query($conn,

    "SELECT * FROM pendaftaran
     WHERE status='tidak_lulus'")

);

/* TOTAL DAFTAR ULANG */
$total_daftar_ulang = mysqli_num_rows(

    mysqli_query($conn,

    "SELECT * FROM pendaftaran
     WHERE status IN (
        'daftar_ulang',
        'selesai'
     )")

);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Dashboard Admin</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold"
           href="#">
            Admin PMB
        </a>

        <div class="navbar-nav ms-auto">

            <a class="nav-link active"
               href="admin.php">
                Dashboard
            </a>

            <a class="nav-link"
               href="data_pendaftar.php">
                Data Pendaftar
            </a>

            <a class="nav-link text-warning"
               href="../auth/logout.php">
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container py-4">

    <!-- WELCOME -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h3 class="fw-bold text-primary">
                Halo Admin,
                <?= $_SESSION['nama']; ?>
            </h3>

            <p class="text-muted mb-0">
                Kelola data penerimaan mahasiswa baru.
            </p>

        </div>

    </div>

    <!-- STATISTIK -->
    <div class="stats-container">

        <div class="stat-card">

            <h3><?= $total_pendaftar; ?></h3>

            <p>Total Pendaftar</p>

        </div>

        <div class="stat-card">

            <h3><?= $total_verifikasi; ?></h3>

            <p>Sudah Diverifikasi</p>

        </div>

        <div class="stat-card">

            <h3><?= $total_lulus; ?></h3>

            <p>Total Lulus</p>

        </div>

        <div class="stat-card">

            <h3><?= $total_tidak_lulus; ?></h3>

            <p>Tidak Lulus</p>

        </div>

        <div class="stat-card">

            <h3><?= $total_daftar_ulang; ?></h3>

            <p>Daftar Ulang</p>

        </div>

    </div>

</div>

</body>
</html>
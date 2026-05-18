<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak!");
}

$id = $_GET['id'];

$query = mysqli_query($conn,

"SELECT * FROM pendaftaran
 WHERE id='$id'"

);

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Jadwal Ujian</title>

    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>
<body>

<div class="container">

    <div class="sidebar">

        <h2>Admin Panel</h2>

        <a href="admin.php">
            Dashboard
        </a>

        <a href="data_pendaftar.php">
            Data Pendaftar
        </a>

    </div>

    <div class="main">

        <div class="card">

            <h3>Atur Jadwal Ujian</h3>

            <br>

            <form action="proses_jadwal.php"
                  method="POST">

                <input type="hidden"
                       name="id"
                       value="<?= $data['id']; ?>">

                <label>Lokasi Ujian</label>

                <input type="text"
                       name="lokasi_ujian"
                       required>

                <label>Tanggal Ujian</label>

                <input type="datetime-local"
                       name="tanggal_ujian"
                       required>

                <button type="submit">
                    Simpan Jadwal
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
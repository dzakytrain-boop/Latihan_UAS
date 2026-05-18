<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
}

$user_id = $_SESSION['id'];

$query = mysqli_query($conn,

"SELECT * FROM pendaftaran
 WHERE user_id='$user_id'"

);

$pendaftaran = mysqli_fetch_assoc($query);

$status_text = '';

if($pendaftaran){

    switch($pendaftaran['status']){

        case 'menunggu':
            $status_text = 'Menunggu Verifikasi';
            break;

        case 'verifikasi':
            $status_text = 'Berkas Sudah Diverifikasi';
            break;

        case 'ujian':
            $status_text = 'Jadwal Ujian Tersedia';
            break;

        case 'menunggu_hasil':
            $status_text = 'Menunggu Hasil Seleksi';
            break;

        case 'lulus':
            $status_text = 'LULUS';
            break;

        case 'tidak_lulus':
            $status_text = 'Tidak Lulus';
            break;

        case 'daftar_ulang':
            $status_text =
            'Menunggu Verifikasi Pembayaran';
            break;

        case 'selesai':
            $status_text =
            'Daftar Ulang Selesai';
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Dashboard Mahasiswa</title>

    <!-- BOOTSTRAP 5 -->
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
            PMB Kampus
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active"
                       href="mahasiswa.php">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="form_pendaftaran.php">
                        Form Pendaftaran
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-warning"
                       href="../auth/logout.php">
                        Logout
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<div class="container py-4">

    <?php if(isset($_SESSION['success'])) : ?>

        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>

    <?php
    unset($_SESSION['success']);
    endif;
    ?>

    <?php if(isset($_SESSION['error'])) : ?>

        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>

    <?php
    unset($_SESSION['error']);
    endif;
    ?>

    <!-- WELCOME -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h3 class="fw-bold text-primary">
                Selamat Datang,
                <?= $_SESSION['nama']; ?>
            </h3>

            <p class="text-muted mb-0">
                Sistem Penerimaan Mahasiswa Baru
            </p>

        </div>

    </div>

    <!-- STATUS -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <h4 class="fw-bold mb-4 text-primary">
                Status Pendaftaran
            </h4>

            <?php if($pendaftaran) : ?>

                <div class="mb-3">

                    <span class="badge bg-primary fs-6">
                        <?= $status_text; ?>
                    </span>

                </div>

                <!-- MENUNGGU HASIL -->
                <?php if($pendaftaran['status'] == 'menunggu_hasil') : ?>

                    <div class="alert alert-info">

                        Ujian telah selesai.
                        Silakan menunggu pengumuman hasil seleksi.

                    </div>

                <?php endif; ?>

                <!-- LULUS -->
                <?php if($pendaftaran['status'] == 'lulus') : ?>

                    <div class="alert alert-success">

                        <h5 class="fw-bold">
                            Selamat!
                        </h5>

                        Anda dinyatakan LULUS seleksi PMB.

                    </div>

                    <!-- BUTTON DAFTAR ULANG -->
                    <button class="btn btn-primary"
                            data-bs-toggle="collapse"
                            data-bs-target="#daftarUlang">

                        Daftar Ulang

                    </button>

                    <!-- COLLAPSE -->
                    <div class="collapse mt-4"
                         id="daftarUlang">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body">

                                <h5 class="fw-bold text-primary mb-3">
                                    Informasi Pembayaran
                                </h5>

                                <p>
                                    <b>Bank:</b>
                                    BCA
                                </p>

                                <p>
                                    <b>No Rekening:</b>
                                    1234567890
                                </p>

                                <p>
                                    <b>Atas Nama:</b>
                                    PMB Kampus
                                </p>

                                <p>
                                    <b>Biaya Daftar Ulang:</b>
                                    Rp 2.500.000
                                </p>

                                <hr>

                                <form action="upload_pembayaran.php"
                                      method="POST"
                                      enctype="multipart/form-data">

                                    <input type="hidden"
                                           name="id"
                                           value="<?= $pendaftaran['id']; ?>">

                                    <label class="form-label fw-semibold">
                                        Upload Bukti Pembayaran
                                    </label>

                                    <input type="file"
                                           name="bukti"
                                           class="form-control mb-3"
                                           required>

                                    <button type="submit"
                                            class="btn btn-success">

                                        Kirim Bukti Pembayaran

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

                <!-- TIDAK LULUS -->
                <?php if($pendaftaran['status'] == 'tidak_lulus') : ?>

                    <div class="alert alert-danger">

                        Mohon maaf,
                        Anda belum lulus seleksi PMB.

                    </div>

                <?php endif; ?>

                <!-- STATUS SELESAI -->
                <?php if($pendaftaran['status'] == 'selesai') : ?>

                    <div class="alert alert-success">

                        Daftar ulang selesai.
                        Selamat bergabung di kampus kami 🎉

                    </div>

                <?php endif; ?>

                <hr>

                <p>
                    <b>Jurusan:</b>
                    <?= $pendaftaran['jurusan_pilihan']; ?>
                </p>

            <?php else : ?>

                <div class="alert alert-warning">

                    Belum melakukan pendaftaran.

                </div>

            <?php endif; ?>

            <!-- JADWAL -->
            <?php if($pendaftaran && $pendaftaran['tanggal_ujian']) : ?>

                <hr>

                <h5 class="fw-bold text-primary">
                    Jadwal Ujian
                </h5>

                <p>
                    <b>Lokasi:</b>
                    <?= $pendaftaran['lokasi_ujian']; ?>
                </p>

                <p>
                    <b>Tanggal:</b>
                    <?= $pendaftaran['tanggal_ujian']; ?>
                </p>

            <?php endif; ?>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
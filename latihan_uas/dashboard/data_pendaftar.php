<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
}

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak!");
}

$query = mysqli_query($conn,

"SELECT p.*, u.nama
 FROM pendaftaran p
 JOIN users u
 ON p.user_id = u.id

 ORDER BY p.id DESC"

);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Data Pendaftar</title>

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

                    <a class="nav-link"
                       href="admin.php">
                        Dashboard
                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link active"
                       href="data_pendaftar.php">
                        Data Pendaftar
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

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex
                        justify-content-between
                        align-items-center
                        mb-4">

                <h3 class="fw-bold text-primary mb-0">
                    Data Pendaftar
                </h3>

                <span class="badge bg-primary">

                    Total:
                    <?= mysqli_num_rows($query); ?>

                </span>

            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Sekolah</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th width="260">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    while($data = mysqli_fetch_assoc($query)) :
                    ?>

                        <tr>

                            <td>
                                <?= $no++; ?>
                            </td>

                            <td class="fw-semibold">
                                <?= $data['nama']; ?>
                            </td>

                            <td>
                                <?= $data['nisn']; ?>
                            </td>

                            <td>
                                <?= $data['asal_sekolah']; ?>
                            </td>

                            <td>
                                <?= $data['jurusan_pilihan']; ?>
                            </td>

                            <td>

                                <?php
                                $badge = 'bg-secondary';

                                if($data['status'] == 'menunggu'){
                                    $badge = 'bg-warning text-dark';
                                }

                                elseif($data['status'] == 'verifikasi'){
                                    $badge = 'bg-info text-dark';
                                }

                                elseif($data['status'] == 'ujian'){
                                    $badge = 'bg-primary';
                                }

                                elseif($data['status'] == 'menunggu_hasil'){
                                    $badge = 'bg-secondary';
                                }

                                elseif($data['status'] == 'lulus'){
                                    $badge = 'bg-success';
                                }

                                elseif($data['status'] == 'tidak_lulus'){
                                    $badge = 'bg-danger';
                                }

                                elseif($data['status'] == 'daftar_ulang'){
                                    $badge = 'bg-dark';
                                }

                                elseif($data['status'] == 'selesai'){
                                    $badge = 'bg-success';
                                }
                                ?>

                                <span class="badge <?= $badge; ?>">

                                    <?= $data['status']; ?>

                                </span>

                            </td>

                            <td>

                                <!-- MENUNGGU -->
                                <?php if($data['status'] == 'menunggu') : ?>

                                    <a href="update_status.php?id=<?= $data['id']; ?>&status=verifikasi"
                                       class="btn btn-sm btn-primary">

                                        Verifikasi

                                    </a>

                                <?php endif; ?>



                                <!-- VERIFIKASI -->
                                <?php if($data['status'] == 'verifikasi') : ?>

                                    <a href="jadwal_ujian.php?id=<?= $data['id']; ?>"
                                       class="btn btn-sm btn-info text-white">

                                        Jadwalkan

                                    </a>

                                <?php endif; ?>



                                <!-- UJIAN -->
                                <?php if($data['status'] == 'ujian') : ?>

                                    <a href="update_status.php?id=<?= $data['id']; ?>&status=menunggu_hasil"
                                       class="btn btn-sm btn-secondary">

                                        Selesai Ujian

                                    </a>

                                <?php endif; ?>



                                <!-- MENUNGGU HASIL -->
                                <?php if($data['status'] == 'menunggu_hasil') : ?>

                                    <div class="d-flex gap-2">

                                        <a href="update_status.php?id=<?= $data['id']; ?>&status=lulus"
                                           class="btn btn-sm btn-success">

                                            Lulus

                                        </a>

                                        <a href="update_status.php?id=<?= $data['id']; ?>&status=tidak_lulus"
                                           class="btn btn-sm btn-danger">

                                            Tidak

                                        </a>

                                    </div>

                                <?php endif; ?>



                                <!-- DAFTAR ULANG -->
                                <?php if($data['status'] == 'daftar_ulang') : ?>

                                    <div class="d-flex
                                                flex-column
                                                gap-2">

                                        <a target="_blank"
                                           href="../uploads/<?= $data['bukti_pembayaran']; ?>"
                                           class="btn btn-sm btn-outline-primary">

                                            Lihat Bukti

                                        </a>

                                        <a href="verifikasi_pembayaran.php?id=<?= $data['id']; ?>"
                                           class="btn btn-sm btn-success">

                                            Verifikasi Pembayaran

                                        </a>

                                    </div>

                                <?php endif; ?>



                                <!-- SELESAI -->
                                <?php if($data['status'] == 'selesai') : ?>

                                    <span class="text-success fw-bold">

                                        ✔ Selesai

                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
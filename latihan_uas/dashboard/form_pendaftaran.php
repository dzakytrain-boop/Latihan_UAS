<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Form Pendaftaran</title>

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
            PMB Kampus
        </a>

        <div class="navbar-nav ms-auto">

            <a class="nav-link"
               href="mahasiswa.php">
                Dashboard
            </a>

            <a class="nav-link active"
               href="form_pendaftaran.php">
                Form Pendaftaran
            </a>

            <a class="nav-link text-warning"
               href="../auth/logout.php">
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container py-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <h3 class="fw-bold text-primary mb-4">
                Form Pendaftaran
            </h3>

            <form action="proses_pendaftaran.php"
                  method="POST">

                <input type="hidden"
                       name="user_id"
                       value="<?= $_SESSION['id']; ?>">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            NISN
                        </label>

                        <input type="text"
                               name="nisn"
                               class="form-control"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            NIK
                        </label>

                        <input type="text"
                               name="nik"
                               class="form-control"
                               required>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tempat Lahir
                        </label>

                        <input type="text"
                               name="tempat_lahir"
                               class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tanggal Lahir
                        </label>

                        <input type="date"
                               name="tanggal_lahir"
                               class="form-control">

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jenis Kelamin
                    </label>

                    <select name="jenis_kelamin"
                            class="form-select">

                        <option value="L">
                            Laki-laki
                        </option>

                        <option value="P">
                            Perempuan
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea name="alamat"
                              class="form-control"
                              rows="3"></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Asal Sekolah
                    </label>

                    <input type="text"
                           name="asal_sekolah"
                           class="form-control">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Jurusan Pilihan
                    </label>

                    <select name="jurusan_pilihan"
                            class="form-select">

                        <option>Informatika</option>
                        <option>Sistem Informasi</option>
                        <option>Teknik Elektro</option>

                    </select>

                </div>

                <button type="submit"
                        class="btn btn-primary">

                    Daftar Sekarang

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
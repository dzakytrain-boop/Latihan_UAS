<?php
session_start();

if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'admin') {

        header("Location: dashboard/admin.php");

    } else {

        header("Location: dashboard/mahasiswa.php");

    }

} else {

    header("Location: auth/login.php");

}
?>
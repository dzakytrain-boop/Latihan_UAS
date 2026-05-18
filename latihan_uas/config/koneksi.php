<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "pmb_kampus"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
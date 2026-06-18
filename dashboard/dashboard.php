<?php

session_start();

include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$totalLab = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM laboratorium"
    )
);

$totalPinjam = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM peminjaman"
    )
);

$totalUser = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM users"
    )
);

$totalMenunggu = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM peminjaman
        WHERE status='Menunggu'"
    )
);

$totalDisetujui = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM peminjaman
        WHERE status='Disetujui'"
    )
);

$totalDitolak = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM peminjaman
        WHERE status='Ditolak'"
    )
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

.card-dashboard{
    border:none;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,.08);
}

.card-dashboard h1{
    font-size:45px;
    font-weight:bold;
}

</style>

</head>

<body>

<?php include "../layouts/sidebar.php"; ?>

<div class="content">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2>
Dashboard Sistem Peminjaman Laboratorium
</h2>

<p class="text-muted">
Selamat datang di sistem pengelolaan laboratorium komputer.
</p>

</div>

</div>

<div class="row">
<div class="row mt-2">

<div class="col-md-4 mb-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1><?= $totalMenunggu ?></h1>

<h5>Peminjaman Menunggu</h5>

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1><?= $totalDisetujui ?></h1>

<h5>Peminjaman Disetujui</h5>

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1><?= $totalDitolak ?></h1>

<h5>Peminjaman Ditolak</h5>

</div>

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1><?= $totalLab ?></h1>

<h5>Total Laboratorium</h5>

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1><?= $totalPinjam ?></h1>

<h5>Total Peminjaman</h5>

</div>

</div>

</div>

<div class="col-md-4 mb-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1><?= $totalUser ?></h1>

<h5>Total User</h5>

</div>

</div>

</div>

</div>

<div class="row mt-3">

<div class="col-md-8">

<div class="card card-dashboard">

<div class="card-header">

Tentang Sistem

</div>

<div class="card-body">

<p>

Sistem Peminjaman Laboratorium Komputer merupakan aplikasi yang digunakan untuk mengelola data laboratorium serta proses peminjaman laboratorium secara digital agar lebih efektif dan terorganisir.

</p>

<hr>

<h6>Fitur Sistem</h6>

<ul>

<li>Pendataan Laboratorium Komputer</li>

<li>Pengajuan Peminjaman Laboratorium</li>

<li>Upload Dokumen Pendukung</li>

<li>Pencarian Data Cepat</li>

<li>Tanda Tangan Digital</li>

<li>Video dan Audio Panduan</li>

<li>Export Laporan</li>

</ul>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card card-dashboard">

<div class="card-header">

Profil Pengguna

</div>

<div class="card-body text-center">

<img
src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
width="90">

<h5 class="mt-3">

<?= $_SESSION['nama']; ?>

</h5>

<span class="badge bg-success">

<?= $_SESSION['role']; ?>

</span>

<hr>

</div>

</div>

</div>

</div>

<footer>
  <p>&copy; 2026 Wepelab. Afdhal Tsany N.</p>
</footer>

</div>

</body>
</html>
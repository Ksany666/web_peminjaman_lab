<?php

include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query(
$koneksi,
"SELECT * FROM laboratorium
WHERE id_lab='$id'"
);

$row = mysqli_fetch_assoc($data);

?>

<!DOCTYPE html>
<html>
<head>

<title>Detail Lab</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<div class="card">

<div class="card-body">

<h3><?= $row['nama_lab'] ?></h3>

<hr>

<img
src="../upload/laboratorium/<?= $row['foto'] ?>"
width="300"
class="mb-3">

<p>

<b>Kapasitas :</b>

<?= $row['kapasitas'] ?>

</p>

<p>

<b>Lokasi :</b>

<?= $row['lokasi'] ?>

</p>

<a href="index.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</body>
</html>
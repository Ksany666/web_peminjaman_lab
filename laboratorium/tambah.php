<?php

include "../config/koneksi.php";

if(isset($_POST['simpan'])){

$nama_lab = $_POST['nama_lab'];
$kapasitas = $_POST['kapasitas'];
$lokasi = $_POST['lokasi'];

$foto = $_FILES['foto']['name'];

move_uploaded_file(
$_FILES['foto']['tmp_name'],
"../upload/laboratorium/".$foto
);

mysqli_query(

$koneksi,

"INSERT INTO laboratorium
(
nama_lab,
kapasitas,
lokasi,
foto
)

VALUES
(
'$nama_lab',
'$kapasitas',
'$lokasi',
'$foto'
)"

);

header("Location:index.php");

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Laboratorium</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h3>Tambah Laboratorium</h3>

<form
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Nama Lab</label>

<input
type="text"
name="nama_lab"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kapasitas</label>

<input
type="number"
name="kapasitas"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Foto</label>

<input
type="file"
name="foto"
class="form-control">

</div>

<button
type="submit"
name="simpan"
class="btn btn-primary">

Simpan

</button>

</form>

</div>

</body>
</html>
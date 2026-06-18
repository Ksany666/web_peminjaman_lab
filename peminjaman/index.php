<?php

session_start();

include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query(

    $koneksi,

    "SELECT

    peminjaman.*,
    users.nama,
    laboratorium.nama_lab

    FROM peminjaman

    JOIN users
    ON peminjaman.id_user = users.id_user

    JOIN laboratorium
    ON peminjaman.id_lab = laboratorium.id_lab

    ORDER BY id_pinjam DESC"

);

$lab = mysqli_query(
    $koneksi,
    "SELECT * FROM laboratorium"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Data Peminjaman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<style>

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<?php include "../layouts/sidebar.php"; ?>

<div class="content">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2>Data Peminjaman Laboratorium</h2>

<p class="text-muted">
Kelola seluruh data peminjaman laboratorium
</p>

</div>

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

Tambah Peminjaman

</button>

</div>

<div class="card">

<div class="card-body">

<div class="mb-3">

    <a
    href="../export/excel.php"
    class="btn btn-success">

    Export Excel

    </a>

</div>

<table
id="myTable"
class="table table-bordered table-striped">

<thead>

<tr>

<th>No</th>
<th>Peminjam</th>
<th>Laboratorium</th>
<th>Kegiatan</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $row['nama'] ?></td>

<td><?= $row['nama_lab'] ?></td>

<td><?= $row['nama_kegiatan'] ?></td>

<td><?= $row['tanggal'] ?></td>

<td>

<?php

if($row['status']=="Menunggu"){

echo "<span class='badge bg-warning'>Menunggu</span>";

}elseif($row['status']=="Disetujui"){

echo "<span class='badge bg-success'>Disetujui</span>";

}else{

echo "<span class='badge bg-danger'>Ditolak</span>";

}

?>

</td>

<td>

<button
class="btn btn-info btn-sm"
data-bs-toggle="modal"
data-bs-target="#detail<?= $row['id_pinjam'] ?>">

Detail

</button>

<a
href="approve.php?id=<?= $row['id_pinjam'] ?>"
class="btn btn-success btn-sm"
onclick="return confirm('Setujui?')">

Approve

</a>

<a
href="reject.php?id=<?= $row['id_pinjam'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Tolak?')">

Reject

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>


<?php

$detail = mysqli_query(

$koneksi,

"SELECT

peminjaman.*,
users.nama,
laboratorium.nama_lab

FROM peminjaman

JOIN users
ON peminjaman.id_user = users.id_user

JOIN laboratorium
ON peminjaman.id_lab = laboratorium.id_lab"

);

while($d=mysqli_fetch_assoc($detail)){

?>

<div
class="modal fade"
id="detail<?= $d['id_pinjam'] ?>">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">

Detail Peminjaman

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<p>

<b>Peminjam :</b>

<?= $d['nama'] ?>

</p>

<p>

<b>Laboratorium :</b>

<?= $d['nama_lab'] ?>

</p>

<p>

<b>Kegiatan :</b>

<?= $d['nama_kegiatan'] ?>

</p>

<p>

<b>Keterangan :</b>

<?= $d['keterangan'] ?>

</p>

<p>

<b>Tanggal :</b>

<?= $d['tanggal'] ?>

</p>

<p>

<b>Jam :</b>

<?= $d['jam_mulai'] ?>

-

<?= $d['jam_selesai'] ?>

</p>

<hr>

<hr>

<h6>Tanda Tangan Digital</h6>

<?php

if($d['ttd']!=""){

?>

<img
src="../upload/dokumen/<?= $d['ttd'] ?>"
width="250">

<?php

}else{

echo "Belum ada TTD";

}

?>

<?php

if($d['file_upload']!=""){

$files = explode(",",$d['file_upload']);

foreach($files as $file){

?>

<a
href="../upload/dokumen/<?= $file ?>"
target="_blank"
class="btn btn-outline-primary btn-sm m-1">

<?= $file ?>

</a>

<?php

}

}else{

echo "Tidak ada dokumen";

}

?>

</div>

</div>

</div>

</div>

<?php } ?>


<div
class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form
action="simpan.php"
method="POST"
enctype="multipart/form-data">

<div class="modal-header">

<h5 class="modal-title">

Tambah Peminjaman

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<div class="mb-3">

<label>Laboratorium</label>

<select
name="id_lab"
class="form-control"
required>

<option value="">
Pilih Laboratorium
</option>

<?php

mysqli_data_seek($lab,0);

while($l=mysqli_fetch_assoc($lab)){

?>

<option value="<?= $l['id_lab'] ?>">

<?= $l['nama_lab'] ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Nama Kegiatan</label>

<input
type="text"
name="nama_kegiatan"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Jam Mulai</label>

<input
type="time"
name="jam_mulai"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Jam Selesai</label>

<input
type="time"
name="jam_selesai"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Upload Dokumen</label>

<input
type="file"
name="file_upload[]"
class="form-control"
multiple>

<hr>

<h6>Tanda Tangan Digital</h6>

<canvas
id="signature-pad"
width="400"
height="150"
style="
border:1px solid #ccc;
border-radius:10px;
background:white;">
</canvas>

<input
type="hidden"
name="ttd"
id="ttd">

<br>

<button
type="button"
class="btn btn-danger btn-sm mt-2"
onclick="clearCanvas()">

Hapus TTD

</button>

</div>

</div>

<div class="modal-footer">

<button
type="submit"
class="btn btn-primary">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

$(document).ready(function(){
    $('#myTable').DataTable();

});

</script>

<script>

const canvas =
document.getElementById("signature-pad");

const ctx =
canvas.getContext("2d");

let drawing=false;

canvas.addEventListener(
"mousedown",
function(e){

drawing=true;

ctx.beginPath();

ctx.moveTo(
e.offsetX,
e.offsetY
);

}
);

canvas.addEventListener(
"mousemove",
function(e){

if(!drawing) return;

ctx.lineTo(
e.offsetX,
e.offsetY
);

ctx.stroke();

}
);

canvas.addEventListener(
"mouseup",
function(){

drawing=false;

document.getElementById("ttd").value =
canvas.toDataURL();

}
);

function clearCanvas(){

ctx.clearRect(
0,
0,
canvas.width,
canvas.height
);

document.getElementById("ttd").value="";

}

</script>

</body>
</html>
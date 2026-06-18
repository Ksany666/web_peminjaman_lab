<?php

session_start();

include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

if(isset($_POST['simpan'])){

    $nama_lab = $_POST['nama_lab'];
    $kapasitas = $_POST['kapasitas'];
    $lokasi = $_POST['lokasi'];

    $foto = "";

    if($_FILES['foto']['name'] != ""){

        $foto = time()."_".$_FILES['foto']['name'];

        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            "../upload/laboratorium/".$foto
        );

    }

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

    echo "
    <script>
        alert('Data berhasil ditambahkan');
        window.location='index.php';
    </script>
    ";

}

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM laboratorium
    ORDER BY id_lab DESC"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Data Laboratorium</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<style>

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.foto-lab{
    width:150px;
    height:90px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #ddd;
    box-shadow:0 2px 8px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<?php include "../layouts/sidebar.php"; ?>

<div class="content">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2>Data Laboratorium</h2>

<p class="text-muted">
Kelola seluruh data laboratorium komputer
</p>

</div>

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

Tambah Laboratorium

</button>

</div>

<div class="card">

<div class="card-body">

<table
id="myTable"
class="table table-bordered table-striped align-middle">

<thead>

<tr>

<th>No</th>
<th>Foto</th>
<th>Nama Lab</th>
<th>Kapasitas</th>
<th>Lokasi</th>
<th width="220">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++ ?></td>

<td>

<?php if($row['foto']!=""){ ?>

<img
src="../upload/laboratorium/<?= $row['foto'] ?>"
class="foto-lab">

<?php }else{ ?>

<span class="badge bg-secondary">
Tidak Ada Foto
</span>

<?php } ?>

</td>

<td><?= $row['nama_lab'] ?></td>

<td><?= $row['kapasitas'] ?></td>

<td><?= $row['lokasi'] ?></td>

<td>

<button
class="btn btn-info btn-sm"
data-bs-toggle="modal"
data-bs-target="#detail<?= $row['id_lab'] ?>">

Detail

</button>

<button
class="btn btn-warning btn-sm"
data-bs-toggle="modal"
data-bs-target="#edit<?= $row['id_lab'] ?>">

Edit

</button>

<a
href="hapus.php?id=<?= $row['id_lab'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<footer>
  <p>&copy; 2026 Wepelab. Afdhal Tsany N.</p>
</footer>

</div>


<?php

$dataDetail = mysqli_query(
$koneksi,
"SELECT * FROM laboratorium"
);

while($d=mysqli_fetch_assoc($dataDetail)){

?>

<div
class="modal fade"
id="detail<?= $d['id_lab'] ?>">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
Detail Laboratorium
</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body text-center">

<?php if($d['foto']!=""){ ?>

<img
src="../upload/laboratorium/<?= $d['foto'] ?>"
class="img-fluid rounded mb-3">

<?php } ?>

<h4><?= $d['nama_lab'] ?></h4>

<hr>

<p>
<b>Kapasitas :</b>
<?= $d['kapasitas'] ?> Orang
</p>

<p>
<b>Lokasi :</b>
<?= $d['lokasi'] ?>
</p>

</div>

</div>

</div>

</div>

<div
class="modal fade"
id="edit<?= $d['id_lab'] ?>">

<div class="modal-dialog">

<div class="modal-content">

<form
action="update.php"
method="POST"
enctype="multipart/form-data">

<div class="modal-header">

<h5 class="modal-title">
Edit Laboratorium
</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<input
type="hidden"
name="id_lab"
value="<?= $d['id_lab'] ?>">

<div class="mb-3">

<label>Nama Laboratorium</label>

<input
type="text"
name="nama_lab"
class="form-control"
value="<?= $d['nama_lab'] ?>"
required>

</div>

<div class="mb-3">

<label>Kapasitas</label>

<input
type="number"
name="kapasitas"
class="form-control"
value="<?= $d['kapasitas'] ?>"
required>

</div>

<div class="mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control"
value="<?= $d['lokasi'] ?>"
required>

</div>

<div class="mb-3">

<label>Foto Baru</label>

<input
type="file"
name="foto"
class="form-control">

</div>

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Tutup

</button>

<button
type="submit"
class="btn btn-primary">

Update

</button>

</div>

</form>

</div>

</div>

</div>

<?php } ?>

<!-- MODAL TAMBAH -->

<div
class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form
method="POST"
enctype="multipart/form-data">

<div class="modal-header">

<h5 class="modal-title">
Tambah Laboratorium
</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<div class="mb-3">

<label>Nama Laboratorium</label>

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

<label>Foto Laboratorium</label>

<input
type="file"
name="foto"
class="form-control">

</div>

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Tutup

</button>

<button
type="submit"
name="simpan"
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

    $('#myTable').DataTable({

        language:{

            search:"Cari Data :",

            lengthMenu:
            "Tampilkan _MENU_ data"

        }

    });

});

</script>

</body>
</html>
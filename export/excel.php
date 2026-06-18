<?php

include "../config/koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_peminjaman.xls");

?>

<table border="1">

<tr>

<th>No</th>
<th>Nama Peminjam</th>
<th>Laboratorium</th>
<th>Tanggal</th>
<th>Status</th>

</tr>

<?php

$no = 1;

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

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $row['nama'] ?></td>

<td><?= $row['nama_lab'] ?></td>

<td>
<?= date('d-m-Y', strtotime($row['tanggal'])) ?>
</td>

<td><?= $row['status'] ?></td>

</tr>

<?php } ?>

</table>
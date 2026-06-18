<?php

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query(

$koneksi,

"UPDATE peminjaman
SET status='Ditolak'
WHERE id_pinjam='$id'"

);

header("Location:index.php");
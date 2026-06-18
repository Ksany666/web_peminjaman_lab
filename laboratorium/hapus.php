<?php

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query(
$koneksi,
"DELETE FROM laboratorium
WHERE id_lab='$id'"
);

header("Location:index.php");
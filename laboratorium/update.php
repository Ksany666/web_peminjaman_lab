<?php

include "../config/koneksi.php";

$id_lab = $_POST['id_lab'];
$nama_lab = $_POST['nama_lab'];
$kapasitas = $_POST['kapasitas'];
$lokasi = $_POST['lokasi'];

if($_FILES['foto']['name'] != ""){

    $foto = time()."_".$_FILES['foto']['name'];

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "../upload/laboratorium/".$foto
    );

    mysqli_query(
        $koneksi,

        "UPDATE laboratorium
        SET
        nama_lab='$nama_lab',
        kapasitas='$kapasitas',
        lokasi='$lokasi',
        foto='$foto'
        WHERE id_lab='$id_lab'"
    );

}else{

    mysqli_query(
        $koneksi,

        "UPDATE laboratorium
        SET
        nama_lab='$nama_lab',
        kapasitas='$kapasitas',
        lokasi='$lokasi'
        WHERE id_lab='$id_lab'"
    );

}

header("Location:index.php");
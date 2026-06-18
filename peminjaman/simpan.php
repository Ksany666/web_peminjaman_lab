<?php

session_start();

include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$id_lab = $_POST['id_lab'];
$nama_kegiatan = $_POST['nama_kegiatan'];
$keterangan = $_POST['keterangan'];
$tanggal = $_POST['tanggal'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];

$fileSimpan = [];

if(!empty($_FILES['file_upload']['name'][0])){

    foreach($_FILES['file_upload']['name'] as $key => $namaFile){

        $namaBaru =
        time().'_'.$namaFile;

        move_uploaded_file(

            $_FILES['file_upload']['tmp_name'][$key],

            "../upload/dokumen/".$namaBaru

        );

        $fileSimpan[] = $namaBaru;

    }

}

$file_upload = implode(",",$fileSimpan);

$ttd = $_POST['ttd'];

$namaTTD = "";

if($ttd!=""){

    $ttd = str_replace(
    'data:image/png;base64,',
    '',
    $ttd
    );

    $ttd = str_replace(
    ' ',
    '+',
    $ttd
    );

    $namaTTD =
    time().'_ttd.png';

    file_put_contents(

        "../upload/dokumen/".$namaTTD,

        base64_decode($ttd)

    );

}

mysqli_query(

    $koneksi,

    "INSERT INTO peminjaman(

        id_user,
        id_lab,
        nama_kegiatan,
        keterangan,
        tanggal,
        jam_mulai,
        jam_selesai,
        file_upload,
        ttd,
        status

    )

    VALUES(

        '$id_user',
        '$id_lab',
        '$nama_kegiatan',
        '$keterangan',
        '$tanggal',
        '$jam_mulai',
        '$jam_selesai',
        '$file_upload',
        '$namaTTD',
        'Menunggu'

    )"

);

echo "

<script>

alert('Peminjaman berhasil diajukan');

window.location='index.php';

</script>

";

?>
<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>TTD Digital</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

canvas{
    border:2px solid #333;
    border-radius:10px;
    background:white;
}

</style>

</head>
<body>

<?php include "../layouts/sidebar.php"; ?>

<div class="content">

<h2>TTD Digital</h2>

<p class="text-muted">
Silakan buat tanda tangan digital
</p>

<div class="card">

<div class="card-body">

<canvas
id="canvas"
width="700"
height="300">
</canvas>

<br><br>

<button
class="btn btn-danger"
onclick="hapusTTD()">

Hapus

</button>

<button
class="btn btn-success"
onclick="simpanTTD()">

Simpan

</button>

</div>

</div>

</div>

<script>

const canvas =
document.getElementById("canvas");

const ctx =
canvas.getContext("2d");

let gambar = false;

canvas.addEventListener(
"mousedown",
function(e){

gambar = true;

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

if(!gambar) return;

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

gambar = false;

}
);

function hapusTTD(){

ctx.clearRect(
0,
0,
canvas.width,
canvas.height
);

}

function simpanTTD(){

var dataURL =
canvas.toDataURL("image/png");

var a =
document.createElement("a");

a.href = dataURL;

a.download =
"ttd_digital.png";

a.click();

}

</script>

</body>
</html>
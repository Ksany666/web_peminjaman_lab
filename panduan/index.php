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

<title>Panduan Sistem</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

<?php include "../layouts/sidebar.php"; ?>

<div class="content">

<h2>Panduan Sistem</h2>

<hr>

<h5>Video Tutorial</h5>

<video
width="700"
controls>

<source
src="../assets/video/panduan.mp4"
type="video/mp4">

</video>

<br><br>

<h5>Audio Informasi</h5>

<audio controls>

<source
src="../assets/audio/audio.mp3"
type="audio/mpeg">

</audio>

<footer>
  <p>&copy; 2026 Wepelab. Afdhal Tsany N.</p>
</footer>

</div>

</body>
</html>
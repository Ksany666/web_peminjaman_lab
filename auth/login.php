<?php

session_start();
include "../config/koneksi.php";

if(isset($_SESSION['login'])){
    header("Location: ../dashboard/dashboard.php");
    exit;
}

$error = "";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string(
        $koneksi,
        $_POST['username']
    );

    $password = $_POST['password'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM users
        WHERE username='$username'"
    );

    if(mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_assoc($query);

         if($password == $data['password']){
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $data['role'];

            header(
                "Location: ../dashboard/dashboard.php"
            );

            exit;

        }else{

            $error =
            "Username atau Password salah";

        }

    }else{

        $error =
        "Username atau Password salah";

    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login Sistem Laboratorium</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:
    linear-gradient(
    135deg,
    #0d6efd,
    #084298
    );

    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;
}

.card-login{
    width:420px;
    border:none;
    border-radius:20px;
    box-shadow:0 0 25px rgba(0,0,0,.2);
}

.logo{
    width:80px;
    height:80px;
    border-radius:50%;
    background:#0d6efd;
    color:white;
    font-size:22px;
    font-weight:bold;

    display:flex;
    align-items:center;
    justify-content:center;

    margin:auto;
}

</style>

</head>
<body>

<div class="card card-login p-4">

<div class="text-center mb-4">

<div class="logo">
LAB
</div>

<h2 class="mt-3">
Sistem Peminjaman
</h2>

<p class="text-muted">
Laboratorium Komputer
</p>

</div>

<?php if($error!=""){ ?>

<div class="alert alert-danger">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>
Username
</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label>
Password
</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

Login

</button>

</form>

<hr>

<p class="text-center text-muted">

© Sistem Laboratorium Komputer

</p>

</div>

</body>
</html>
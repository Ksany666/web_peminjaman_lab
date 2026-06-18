<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<style>

body{
    margin:0;
    background:#f4f6f9;
    font-family:Segoe UI;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#0d6efd;
    position:fixed;
    left:0;
    top:0;
    color:white;
}

.logo{
    text-align:center;
    font-size:35px;
    font-weight:bold;
    padding:25px 0;
}

.user-box{
    padding:20px;
    border-top:1px solid rgba(255,255,255,.2);
    border-bottom:1px solid rgba(255,255,255,.2);
}

.menu{
    margin-top:20px;
}

.menu a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px 25px;
    transition:.3s;
}

.menu a:hover{
    background:rgba(255,255,255,.15);
}

.content{
    margin-left:250px;
    padding:30px;
}

</style>

<div class="sidebar">

<div class="logo">
LABKOM
</div>

<div class="user-box">

<div>Login Sebagai :</div>

<b><?= $_SESSION['nama']; ?></b>

</div>

<div class="menu">

<a href="../dashboard/dashboard.php">
🏠 Dashboard
</a>

<a href="../laboratorium/index.php">
🖥 Data Laboratorium
</a>

<a href="../peminjaman/index.php">
📋 Data Peminjaman
</a>

<a href="../panduan/index.php">
🎥 Panduan
</a>

<a href="../ttd/canvas.php">
✍️ TTD Digital
</a>

<a href="../auth/logout.php">
🚪 Logout
</a>

</div>

</div>
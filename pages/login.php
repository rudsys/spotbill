<?php
include 'header.php';

//START SESSION
session_start();
date_default_timezone_set('Asia/Jakarta');
?>

<body class="login-page dark-mode" style="min-height: 466px;">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h3 id="hlogin">...</h3>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan Login Untuk Memulai</p>
                <form action="../process/login.php" method="post">
                </form>
                <p class="mb-1">Daftar mitra..? <a href="register.php">Disini</a></p>
            </div>
        </div>
    </div>

    <div class="alert">...</div>

    <br>

<?php include 'footer.php'?>

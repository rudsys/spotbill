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
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">Daftar mitra..? <a href="register.php">Disini</a></p>
            </div>
        </div>
    </div>

    <div class="alert">...</div>

    <br>

<?php include 'footer.php'?>

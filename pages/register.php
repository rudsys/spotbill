<?php
include 'header.php';

date_default_timezone_set('Asia/Jakarta');
?>

<body class="register-page dark-mode" style="min-height: 466px;">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h3 id="hlogin">...</h3>
            </div>
            <div class="card-body">
                <p class="register-box-msg">Daftar Mitra Baru</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" id="real_name" name="real_name" class="form-control" placeholder="Nama Panggilan / Kios" required>
                        <div class="input-group-append">
                            <div class="input-group-text"> <span class="fa fa-user"></span> </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username Login" required>
                        <div class="input-group-append">
                            <div class="input-group-text"> <span class="fa fa-user"></span> </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password Login" required>
                        <div class="input-group-append">
                            <div class="input-group-text"> <span class="fa fa-lock"></span> </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-4">
                            <button class="btn btn-danger btn-block" onclick="window.location.href='login.php'" type="button">Batal</button>
                        </div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                    </div>
                </form>
                <p class="text-muted" style="font-size: 12px; margin-top: 10px;"> * Dengan mendaftar... berarti anda menyetujui segala aturan dan persyaratan yang berlaku. </p>
                <p class="mb-1">Sudah daftar ? <a href="login.php">Login disini</a></p>
            </div>
        </div>
    </div>

    <br>

<?php
include 'footer.php'
?>

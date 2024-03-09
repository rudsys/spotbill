<?php
session_start();
include '../config/dbase.php';
date_default_timezone_set('Asia/Jakarta');

$login_error = ''; // Inisialisasi variabel login_error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_input = $_POST['login_input'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbl_users WHERE username = '$login_input' OR user_id = '$login_input'";
    $result = $conn->query($sql);

    // ...

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            if ($row['status'] == 'pending') {
                $login_error = "Gagal login, username belum dapat digunakan, status pending";
            } else {
                // Setel sesi user_id setelah login berhasil
                $_SESSION['user_id'] = $row['user_id'];

                // Update last_login
                $currentDateTime = date('Y-m-d H:i:s');
                $updateLastLoginQuery = "UPDATE tbl_users SET last_login = '$currentDateTime' WHERE user_id = '{$row['user_id']}'";
                $conn->query($updateLastLoginQuery);

                // Redirect based on tipe
                switch ($row['tipe']) {
                    case 'reseller':
                        header("Location: dashboard.php");
                        break;
                    case 'operator':
                        header("Location: op/index.php");
                        break;
                    case 'admin':
                        header("Location: adm/index.php");
                        break;
                    case 'teknisi':
                        header("Location: tek/index.php");
                        break;
                    default:
                        // Handle other cases if needed
                        break;
                }
                exit();
            }
        } else {
            $login_error = "Password salah!";
        }
    } else {
        $login_error = "Username / User ID Tidak Ditemukan";
    }
    $conn->close();

    // ...

}
?>

<body class="login-page dark-mode" style="min-height: 466px;">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h3><b>Masalembo</b>.ID</h3>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan Login Untuk Memulai</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" id="login_input" name="login_input" class="form-control" placeholder="Username / ID User">
                        <div class="input-group-append">
                            <div class="input-group-text"> <span class="fa fa-user"></span> </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text"> <span class="fa fa-lock"></span> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" id="btnClick">Login</button>
                        </div>
                    </div>
                    <br/>
                </form>
                <p class="mb-1">Daftar mitra..? <a href="f_register.php">Disini</a></p>
                <!-- <p class="mb-1"> <a href="recovery.php">Lupa Password</a></p> -->

            </div>
        </div>
    </div>

    <br>
    <!-- Pesan error login -->
    <?php if (!empty($login_error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $login_error ?>
                </div>
    <?php endif; ?>
    <!-- Akhir pesan error -->


    <script>
    $(document).ready(function () {
        $('#btnClick').click(function () { // Ganti 'loginBtn' dengan ID tombol login sesuai kebutuhan
            showPreloader(); // Tampilkan preloader sebelum mengirim permintaan

            // Lakukan pengiriman permintaan AJAX atau navigasi halaman login di sini
            // Contoh menggunakan fungsi setTimeout untuk simulasi waktu proses
            setTimeout(function () {
                // Semua langkah selesai, sembunyikan preloader
                hidePreloader();
            }, 5000); // Ganti 3000 dengan waktu proses sebenarnya (ms)
        });

        function showPreloader() {
            $('#preloader').show();
        }

        function hidePreloader() {
            $('#preloader').hide();
        }
    });

</script>

</body>
</html>

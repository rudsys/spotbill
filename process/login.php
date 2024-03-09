<?php
session_start();
require '../config/dbase.php';
date_default_timezone_set('Asia/Jakarta');

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_input = $_POST['login_input'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbl_users WHERE username = '$login_input' OR user_id = '$login_input'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // ...
        } else {
            $login_error = "Password salah!";
        }
    } else {
        $login_error = "Username / User ID Tidak Ditemukan";
    }
    $conn->close();
}
?>

<!-- Output pesan error login -->
<?php if (!empty($login_error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $login_error ?>
    </div>
<?php endif; ?>


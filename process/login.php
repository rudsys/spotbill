<?php
session_start();
require '../config/dbase.php';
date_default_timezone_set('Asia/Jakarta');

$login_error = ''; // Inisialisasi variabel login_error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_input = $_POST['login_input'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbl_users WHERE username = '$login_input' OR user_id = '$login_input'";
    $result = $conn->query($sql);

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
                    header("Location: ../mitra.php");
                    break;
                case 'operator':
                    header("Location: ../operator.php");
                    break;
                case 'admin':
                    header("Location: ../admin.php");
                    break;
                case 'teknisi':
                    header("Location: ../teknisi.php");
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

}
?>

<!-- Output pesan error login -->
<?php if (!empty($login_error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $login_error ?>
    </div>
<?php endif; ?>


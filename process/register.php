<?php
include '../config/dbase.php'; // Sertakan file koneksi
date_default_timezone_set('Asia/Jakarta');

$register_error = ''; // Inisialisasi variabel login_error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $real_name = $_POST['real_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $tipe = 'reseller'; // Default tipe reseller
    $status = 'pending'; // Default status pending

    // Check if the username is already taken
    $check_username_query = "SELECT * FROM tbl_users WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_query);

    if ($check_username_result->num_rows > 0) {
        $register_error = "Username sudah digunakan, silahkan ganti username yang lain";
    } else {
        // Generate 6-digit random number prefixed with 'R'
        $user_id = 'R' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

        // Insert user data into the database
        $sql = "INSERT INTO tbl_users (user_id, real_name, username, password, tipe, status) VALUES ('$user_id', '$real_name', '$username', '$password', '$tipe', '$status')";

        if ($conn->query($sql) === TRUE) {
            $register_error = "Pendaftaran berhasil! User ID: $user_id";
        } else {
            $register_error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!-- Pesan error registrasi -->
<?php if (!empty($register_error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $register_error ?>
        </div>
    <?php endif; ?>
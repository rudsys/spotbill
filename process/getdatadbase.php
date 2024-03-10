<?php

// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$sqlUser = "SELECT user_id, username, saldo FROM tbl_users WHERE user_id = '$user_id'";
$resultUser = $conn->query($sqlUser);

if ($resultUser->num_rows == 1) {
    $rowUser = $resultUser->fetch_assoc();
    $username = $rowUser['username'];
    $saldo = $rowUser['saldo'];
} else {
    // Jika data pengguna tidak ditemukan (seharusnya tidak terjadi)
    echo "Error: Data pengguna tidak ditemukan.";
    exit();
}

// AMBIL DATA DARI topup_request
$sqlTopupRequest = "SELECT * FROM topup_request WHERE user_id = '$user_id'";
$resultTopupRequest = $conn->query($sqlTopupRequest);

// AMBIL DATA DARI tbl_transaksi
$sqlTblTransaksi = "SELECT * FROM tbl_transaksi WHERE user_id = '$user_id'";
$resultTblTransaksi = $conn->query($sqlTblTransaksi);

// AMBIL DATA DARI tbl_listprofile
$sqlTblListProfile = "SELECT * FROM tbl_listprofile";
$resultTblListProfile = $conn->query($sqlTblListProfile);

if (!$result) {
    die('Error fetching data from tbl_listProfile: ' . $conn->error);
}

// AMBIL HASIL QUERY DAN SIMPAN DALAM ARRAY
$list_vouchers = [];
while ($row = $result->fetch_assoc()) {
    $list_vouchers[] = [
        'id' => $row['id'],
        'nama_profile' => $row['nama_profile'],
        'harga_modal' => $row['harga_modal'],
        'harga_jual' => $row['harga_jual'],
        'limit_up_time' => $row['limit_up_time'],
        'limit_kuota' => $row['limit_kuota'],
    ];
}

//TOTAL LABA JUAL
$sqlTotalLaba = "
    SELECT
        COUNT(*) AS jumlah_transaksi,
        SUM(tbl_transaksi.harga_jual - tbl_transaksi.harga_modal) AS total_laba
    FROM
        tbl_transaksi
    WHERE
        user_id = '$user_id'
        AND MONTH(tgl_generate) = MONTH(CURRENT_DATE())
        AND YEAR(tgl_generate) = YEAR(CURRENT_DATE())
";

$resultTotalLaba = $conn->query($sqlTotalLaba);

if ($resultTotalLaba->num_rows == 1) {
    $rowTotalLaba = $resultTotalLaba->fetch_assoc();
    $jumlah_transaksi = $rowTotalLaba['jumlah_transaksi'];
    $total_laba = $rowTotalLaba['total_laba'];
} else {
    $jumlah_transaksi = 0;
    $total_laba = 0;
}

// AMBIL DATA SALDO RESELLER NAME FROM TBL_USERS
$querySaldo = "SELECT saldo FROM tbl_users WHERE user_id = ?";
$resultSaldo = $conn->prepare($querySaldo);
$resultSaldo->bind_param("s", $_SESSION['user_id']);
$resultSaldo->execute();
// Bind the result variables
$resultSaldo->bind_result($saldo);
$resultSaldo->fetch();

// Fetch the reseller details
$selected_Reseller = ['saldo' => $saldo];

if ($resultSaldo) {
    $resultSaldo->close();
}

if (!$selected_Reseller) {
    die('Reseller not found.');
}

$conn->close();

?>
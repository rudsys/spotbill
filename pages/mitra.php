<?php 
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

date_default_timezone_set('Asia/Jakarta');

require '../process/getdatadbase.php';
require '../include/fpdf/fpdf.php';
include '../pages/header.php';
?>

<body class="dark-mode">
        <div class="content-header" id="idHeader">
        <div class="row">
            <div class="col-sm-6 col-6">
                <h4 class="m-0">Hai <?= $username ?></h4>
                <p class="Uid">User ID : <?= $user_id ?></p>
            </div>

    <!-- <nav class="main navbar navbar-expand col-5"> -->
    <nav class="main navbar navbar-expand col-sm-6 col-6">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item col-3">
        <a class="nav-link" href="../pages/listvoucher.php">
          <i class="fa fa-ticket"></i>
          <small class="d-block text-muted">Voucher</small>
        </a>
      </li>

      <li class="nav-item col-3">
        <a class="nav-link" href="../process/getstatustransaksi.php">
          <i class="fa fa-history"></i>
          <small class="d-block text-muted">History</small>
        </a>
      </li>

      <li class="nav-item col-3">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user"></i>
          <small class="d-block text-muted">Akun</small>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <div class="dropdown-divider"></div>
          <a href="../pages/useredit.php" class="dropdown-item">
            <i class="fa fa-edit mr-2"></i> Edit User
          </a>
          <div class="dropdown-divider"></div>
          <a href="../process/logout.php" class="dropdown-item">
            <i class="fa fa-power-off mr-2"></i> Logout
          </a>
          <div class="dropdown-divider"></div>
        </div>

      </li>
    </ul>
  </nav>
        </div>

        <div class="row">
            <div class="col">
                <div class="small-box bg-gradient-success text-center text-nowrap">
                    <div class="inner">
                        <p>Saldo Anda</p>
                        <h5 id="saldo">Rp <?= number_format($saldo, 0, ',', '.'); ?></h5>
                    </div>
                    <?php
                    if ($saldo <= 50000) {
                        echo '<a id="topupBtn" href="topup.php" class="btn btn-secondary btn-block">TopUp Saldo</a>';
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                    <div class="small-box bg-gradient-warning text-center text-nowrap">
                        <div class="inner">
                            <p>Total Laba Anda</p>
                            <h5 id="totalLaba"></h5>
                        </div>
                    </div>
                </div>
        </div>

            </div>
        </div>
            
<div class="container">
<section class="content" id="idContent" style="margin-top:250px">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/img/slide/slide1.png" alt="Los Angeles" class="d-block w-100 rounded">
        </div>
        <div class="carousel-item">
            <img src="assets/img/slide/slide2.png" alt="Chicago" class="d-block w-100 rounded">
        </div>
        <div class="carousel-item">
            <img src="assets/img/slide/slide3.png" alt="New York" class="d-block w-100 rounded">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<br>
<div class="row">
          <div class="col-12">
            <div class="info-box bg-gradient-info">
              <span class="info-box-icon"><i class="fa fa-bookmark"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Kuota Anda Terpakai</span>
                <span class="info-box-number" id="kuotaLabel">Loading..</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 0%"></div>
                </div>
                <span class="progress-description" id="limitBytesReseller">Loading..</span>
              </div>
            </div>
          </div>
 
        </div>

<br>

<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <div class="card-title" id="topupTitle" style="font-size: 14px;" >#Header Tabel</div>

                <div class="card-tools">
    <div class="input-group input-group-sm" style="max-width: 130px;">
        <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Cari" id="cariTabel"> -->
        <!-- <div class="input-group-append">
            <button type="button" class="btn btn-default">
                <i class="fa fa-search"></i>
            </button>
        </div> -->
    </div>
</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap" id="topupTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tgl & Jam</th>
                            <th>Transaksi</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        function formatTanggalJam($tglJamMySQL)
                        {
                            // Mengubah format tanggal dan jam dari MySQL ke format yang diinginkan
                            return date('d-m-Y H:i', strtotime($tglJamMySQL));
                        }

                        // Tampilkan data topup_request
                        $counter = 1;
                        while ($rowTopupRequest = $resultTopupRequest->fetch_assoc()) {
                            $tgl_topup_formatted = formatTanggalJam($rowTopupRequest['tgl_topup']);

                            $statusClass = '';
                            if ($rowTopupRequest !== null && isset($rowTopupRequest['status'])) {
                                $statusClass = ($rowTopupRequest['status'] == 'confirm') ? 'bg-success text-white' : 'bg-danger text-white';
                            } else {
                                $statusClass = 'bg-secondary text-white';
                            }

                            echo "<tr>
                                    <td>{$counter}</td>
                                    <td>{$tgl_topup_formatted}</td>
                                    <td>Top-Up</td>
                                    <td>Rp " . number_format($rowTopupRequest['nominal'], 0, ',', '.') . "</td>
                                    <td class='{$statusClass}'>{$rowTopupRequest['status']}</td>
                                </tr>";
                            $counter++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</section>

    <!-- Footer Menu Navigasi -->
    <!-- <div class="col-12 col-lg-6 mt-5">
        <nav class="navbar navbar-expand navbar-primary navbar-dark fixed-bottom">
            <div class="container">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="listVoucher.php"><i class="fa fa-ticket"></i> Voucher</a></li>
                    <li class="nav-item"><a class="nav-link" href="getstatusTransaksi.php"><i class="fa fa-file-text"></i> Histori</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Keluar</a></li>
                </ul>
            </div>
        </nav>
    </div> -->

    <?php  include('../pages/footer.php'); ?>
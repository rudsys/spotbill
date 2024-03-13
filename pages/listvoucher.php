<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

date_default_timezone_set('Asia/Jakarta');

require '../process/getdatadbase.php';
include '../pages/header.php';
include '../include/formatbytes.php';
?>

<div class="container d-flex align-items-center justify-content-center;">
            <div class="row mt-5">
            <?php foreach ($list_vouchers as $voucher): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card card-outline card-primary">

                            <div class="card-header">
                                <h3 class="card-title"><?php echo $voucher['nama_profile']; ?> | Rp. <?php echo number_format($voucher['harga_jual'], 0, ',', '.'); ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                            </div>
                            <div class="card-body p-0" style="display: block;">
                            <div class="row">
                                <div class="col-md-8"></div>
                            </div>
                        </div>

                        <div class="card-footer p-0" style="display: block;">
                        <ul class="nav nav-pills flex-column">
                            <!-- <li class="nav-item">
                            <a class="nav-link">Voucher
                                <span class="float-right text-warning">
                                    <i class="fas fa-arrow-alt-circle-down text-m"><?php echo $voucher['nama_profile']; ?></i>
                                </span>
                            </a>
                        </li> -->
                            <li class="nav-item">
                                <a class="nav-link">Harga Jual
                                    <span class="float-right text-success">
                                        <i class="fa fa-arrow-up text-m"> Rp. <?php echo number_format($voucher['harga_jual'], 0, ',', '.'); ?></i>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link">Harga Modal
                                    <span class="float-right text-warning">
                                        <i class="fa fa-arrow-left text-m"> Rp. <?php echo number_format($voucher['harga_modal'], 0, ',', '.'); ?></i>
                                    </span>
                                </a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link">Masa Berlaku
                                    <span class="float-right text-danger">
                                        <i class="fa fa-arrow-down text-m"> <?php echo $voucher['limit_up_time']; ?> Hari</i>
                                    </span>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                            <a class="nav-link">Isi Kuota
                                <span class="float-right text-danger">
                                    <i class="fas fa-arrow-alt-circle-down text-sm"><?php echo formatBytes2($voucher['limit_kuota'] * 1024 * 1024 * 1024); ?></i>
                                </span>
                            </a>
                        </li> -->
                        </ul>
                    </div>

                    <a href="createVoucher.php?id=<?php echo $voucher['id']; ?>" class="col-12 btn btn-primary" data-toggle="modal"><i class="fa fa-cart-plus"></i> Beli</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
                        
                            
                            
<?php include('../pages/footer.php'); ?>
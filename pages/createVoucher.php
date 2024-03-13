<div class="container d-flex align-items-center justify-content-center" style="height: 90vh;">
    <div class="card card-outline card-primary" id="createVoucher">
        <!-- CARD HEADER -->
        <div class="card-header text-center">
            <h5><?php echo $selected_profile['nama_profile']; ?></h5>
            </div>
        <div class="card-body" style="margin-top: 5px;">
            <p class="card-text">Harga Modal: Rp. <?php echo number_format($selected_profile['harga_modal'], 0, ',', '.'); ?></p>
            <p class="card-text">Harga Jual: Rp. <?php echo number_format($selected_profile['harga_jual'], 0, ',', '.'); ?></p>
            <p class="card-text">Masa Berlaku: <?php echo $selected_profile['limit_up_time']; ?> Hari</p>
            <p class="card-text">Limit Kuota: <?php echo formatBytes2($selected_profile['limit_kuota'] * 1024 * 1024); ?></p>
            <p class="card-text">Mitra: <?php echo $selected_Reseller['real_name']; ?></p>

            <!-- Add quantity dropdown -->
            <div class="form-group col-12">
    <label for="quantity">Jumlah (Max 10 item)</label>
    <select class="form-control" id="quantity" name="quantity" onchange="updateTotal()">
        <?php for ($i = 1; $i <= 10; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
</div>

<?php
$totalBelanja = $selected_profile['harga_modal'];
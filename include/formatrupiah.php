<?php
function formatRupiah($angka){
    $rupiah = number_format($angka, 0, ',', '.');
    return 'Rp ' . $rupiah;
}
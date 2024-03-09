<?php
function formatTanggal($tanggal){
    setlocale(LC_TIME, 'id_ID');
    return strftime('%A, %d %B %Y', strtotime($tanggal));
}
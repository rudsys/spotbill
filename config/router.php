<?php

require('../include/routeros_api.class.php');

$API = new RouterosAPI();
// $host = 'id27.tunnel.my.id';
$host = '';
$user = '';
$pass = '';

if (!$API->connect($host, $user, $pass)) {
    die('Gagal Terhubung Dengan Router');
}

?>

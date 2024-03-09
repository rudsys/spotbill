<?php
session_start();

$_SESSION = array();
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: pages/login.php");
// header("Location: pages/maintenance.php");
exit();

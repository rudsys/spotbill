<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname   = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure that the connection is set to use UTF-8 character encoding
$conn->set_charset("utf8");
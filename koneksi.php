<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kasir";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set header agar output selalu JSON
header('Content-Type: application/json');
?>
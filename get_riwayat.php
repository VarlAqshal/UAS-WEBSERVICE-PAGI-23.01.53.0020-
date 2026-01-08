<?php
include 'koneksi.php';

// Query untuk mengambil riwayat transaksi JOIN dengan nama user
$query = "SELECT transaksi.*, user.nama_lengkap 
          FROM transaksi 
          JOIN user ON transaksi.id_user = user.id_user 
          ORDER BY transaksi.tgl_transaksi DESC";

$result = mysqli_query($conn, $query);
$riwayat = array();

while ($row = mysqli_fetch_assoc($result)) {
    $riwayat[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $riwayat
]);
?>
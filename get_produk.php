<?php
include 'koneksi.php';

// Query menggabungkan tabel produk dan kategori
$query = "SELECT produk.*, kategori.nama_kategori 
          FROM produk 
          JOIN kategori ON produk.id_kategori = kategori.id_kategori";

$result = mysqli_query($conn, $query);
$array_produk = array();

while ($row = mysqli_fetch_assoc($result)) {
    $array_produk[] = $row;
}

if ($array_produk) {
    echo json_encode([
        "status" => "success",
        "data" => $array_produk
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Produk tidak ditemukan"
    ]);
}
?>
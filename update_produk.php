<?php
include 'koneksi.php';

$id = $_POST['id_produk'];
$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok']; // Angka yang diinput di form edit

// SQL: stok = stok + '$stok' artinya stok lama ditambah input baru
$query = "UPDATE produk SET 
          nama_produk='$nama', 
          harga='$harga', 
          stok = stok + '$stok' 
          WHERE id_produk='$id'";

if(mysqli_query($conn, $query)) {
    echo json_encode(["status" => "success", "message" => "Update Berhasil"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
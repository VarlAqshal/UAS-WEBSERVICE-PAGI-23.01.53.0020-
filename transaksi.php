<?php
include 'koneksi.php';

// Mengambil data JSON yang dikirim oleh Client
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['id_user']) && isset($data['items'])) {
    $id_user = $data['id_user'];
    $total_harga = $data['total_harga'];
    $items = $data['items']; // Ini berupa array barang

    // 1. Simpan ke tabel 'transaksi' (Header)
    $query_transaksi = "INSERT INTO transaksi (id_user, total_harga) VALUES ('$id_user', '$total_harga')";
    
    if (mysqli_query($conn, $query_transaksi)) {
        $id_transaksi = mysqli_insert_id($conn); // Mengambil ID transaksi yang baru saja dibuat

        // 2. Simpan setiap barang ke 'transaksi_detail' & Update Stok
        foreach ($items as $item) {
            $id_produk = $item['id_produk'];
            $jumlah = $item['jumlah'];
            $subtotal = $item['subtotal'];

            // Simpan detail
            $query_detail = "INSERT INTO transaksi_detail (id_transaksi, id_produk, jumlah, subtotal) 
                             VALUES ('$id_transaksi', '$id_produk', '$jumlah', '$subtotal')";
            mysqli_query($conn, $query_detail);

            // 3. Update (Kurangi) Stok Produk
            $query_update_stok = "UPDATE produk SET stok = stok - $jumlah WHERE id_produk = '$id_produk'";
            mysqli_query($conn, $query_update_stok);
        }

        echo json_encode([
            "status" => "success",
            "message" => "Transaksi Berhasil Disimpan",
            "id_transaksi" => $id_transaksi
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan transaksi"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
}
?>
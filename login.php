<?php
include 'koneksi.php';

// Menangkap data yang dikirim oleh aplikasi client
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

if (!empty($user) && !empty($pass)) {
    // Query untuk cek user
    $query = "SELECT * FROM user WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        // Jika data ditemukan
        echo json_encode([
            "status" => "success",
            "message" => "Login Berhasil",
            "data" => [
                "id_user" => $data['id_user'],
                "nama" => $data['nama_lengkap']
            ]
        ]);
    } else {
        // Jika data tidak ditemukan
        echo json_encode([
            "status" => "error",
            "message" => "Username atau Password Salah"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak boleh kosong"
    ]);
}
?>
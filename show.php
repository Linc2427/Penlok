<?php
include 'config.php';

// Ambil ID gambar dari URL
$image_id = $_GET['id'];

// Query untuk mengambil informasi gambar berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM `images` WHERE `id` = $image_id");

// Pastikan gambar ditemukan
if(mysqli_num_rows($query) > 0) {
    $image_data = mysqli_fetch_assoc($query);
    $image_name = $image_data['image']; // Nama file gambar

    // Tampilkan gambar
    echo "<img src='$image_name' alt='Gambar'>";
    echo "<br><a href='index.php'>Kembali</a>";
} else {
    echo "Gambar tidak ditemukan.";
}
?>

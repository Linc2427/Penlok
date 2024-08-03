<?php
$server = "localhost";
$user = "penlok";
$pass = "ykMdBwyTchrEFwZi";
$database = "penlok";

// Membuat koneksi ke database
$conn = new mysqli($server, $user, $pass, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah ada file yang diunggah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $upload_dir = 'uploads/';
    $filename = basename($_FILES['image']['name']);
    $upload_file = $upload_dir . $filename;
    
    // Memindahkan file yang diunggah ke direktori tujuan
    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
        // Menyimpan informasi file ke database
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO images (image, upload_time) VALUES ('$filename', '$timestamp')";
        if ($conn->query($sql) === TRUE) {
            echo "File berhasil diupload dan data disimpan ke database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Gagal mengupload file.";
    }
} else {
    echo "Permintaan tidak valid.";
}

// Menutup koneksi
$conn->close();
?>

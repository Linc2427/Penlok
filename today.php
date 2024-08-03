<?php
include 'config.php';
$today = date('Y-m-d');

// Query untuk menghitung total gambar hari ini dari kedua tabel
$query = "
    SELECT COUNT(*) AS total_today
    FROM (
        SELECT upload_time FROM Kamera1 WHERE DATE(upload_time) = '$today'
        UNION ALL
        SELECT upload_time FROM Kamera2 WHERE DATE(upload_time) = '$today'
    ) AS combined_images
";

$result_today = mysqli_query($conn, $query);
$row_today = mysqli_fetch_assoc($result_today);
$total_today = $row_today['total_today'];

echo $total_today;

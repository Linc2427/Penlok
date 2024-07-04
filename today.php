<?php
include 'config.php';
$today = date('Y-m-d');
$result_today = mysqli_query($conn, "SELECT COUNT(*) AS total_today FROM images WHERE DATE(upload_time) = '$today'");
$row_today = mysqli_fetch_assoc($result_today);
$total_today = $row_today['total_today'];
echo $total_today;
?>
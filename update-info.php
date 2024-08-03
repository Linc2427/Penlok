<?php
require 'config.php';
$tampil = mysqli_query($conn, "SELECT image, id, upload_time FROM Kamera1 UNION SELECT image, id, upload_time FROM Kamera2;");
$rowcount = mysqli_num_rows($tampil);
echo $rowcount;

<?php
require 'config.php';
$tampil = mysqli_query($conn, "SELECT * FROM Kamera1 ORDER BY id");
$rowcount = mysqli_num_rows($tampil);
echo $rowcount;

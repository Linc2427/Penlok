<?php
    require 'config.php';
    $tampil = mysqli_query($conn, "SELECT * FROM images ORDER BY id");
    $rowcount = mysqli_num_rows($tampil);
    echo $rowcount;
?>
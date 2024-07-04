<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM images where `id` = '$id'");
    while ($row = mysqli_fetch_assoc($query)) {
        $image = $row['image'];
    }
    header("Content-Type: image/png");
    echo $image;
} else {
    echo "Error:";
}
?>
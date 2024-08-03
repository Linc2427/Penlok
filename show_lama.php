<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM images WHERE `id` = '$id'");

    if ($row = mysqli_fetch_assoc($query)) {
        $image = $row['file_path'];
        $upload_time = $row['upload_time'];
    } else {
        echo "Image not found.";
        exit;
    }
} else {
    echo "No image ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Image Details</title>
</head>

<body>
    <h1>Image Details</h1>
    <p>Upload Time: <?= $upload_time; ?></p>
    <img src="data:image/jpg;base64,<?= base64_encode(file_get_contents($image)); ?>" alt="Image" />
    <p><a href="index.php">Back to list</a></p>
</body>

</html>
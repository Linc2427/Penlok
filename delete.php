<?php
require 'config.php';

$id = $_GET['id'];

$sql1 = "DELETE FROM `Kamera1` WHERE `id` = '$id'";
$sql2 = "DELETE FROM `Kamera2` WHERE `id` = '$id'";
$query1 = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);

if ($query1 || $query2) {
    echo "<script>
    alert ('Data Berhasil Dihapus');
    document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
    alert ('Data Gagal Dihapus');
    document.location.href = 'index.php';
    </script>";
}

<?php
require 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM `images` WHERE `id` = '$id'";
$query = mysqli_query($conn, $sql);

if ($query) {
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

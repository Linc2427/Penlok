<?php

$server = "localhost";
$user = "penlok";
$pass = "ykMdBwyTchrEFwZi";
$database = "penlok";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

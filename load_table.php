<?php
include 'config.php';

// Set default page to 1 if 'page' query string is not set
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 10;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM images ORDER BY id LIMIT $offset, $limit";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $no = ($page - 1) * $limit + 1; // Hitung nomor urut berdasarkan halaman
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['upload_time'] . "</td>";
        echo "<td><a href='show.php?id={$row['id']}'>Details</a> | <a href='delete.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No data available</td></tr>";
}
?>

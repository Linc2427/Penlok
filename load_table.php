<?php
include 'config.php';

// Set default page to 1 if 'page' query string is not set
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$limit = 10;
$offset = ($page - 1) * $limit;

// Query untuk mengambil data dari kedua tabel dengan paginasi
$query = "
    SELECT * FROM (
        SELECT id, upload_time, image, REPLACE('Kamera1', 'Kamera1', 'Kamera 1') AS source FROM Kamera1
        UNION ALL
        SELECT id, upload_time, image, REPLACE('Kamera2', 'Kamera2', 'Kamera 2') AS source FROM Kamera2
    ) AS combined_images
    ORDER BY upload_time DESC
    LIMIT $offset, $limit
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // $no = ($page - 1) * $limit + 1; // Hitung nomor urut berdasarkan halaman
    $num = $offset;
    while ($row = mysqli_fetch_assoc($result)) {
        $num++;
        $datetime = new DateTime($row['upload_time']);
        $datetime->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $local_time = $datetime->format('d-M-Y | H:i:s');
        echo "<tr>";
        echo "<td>{$num}</td>";
        echo "<td>{$local_time}</td>";
        echo "<td>{$row['source']}</td>";
        echo "<td><a href='#' class='details-btn' data-id='{$row['id']}'>Details</a> | <a href='delete.php?id={$row['id']}'>Delete</a></td>";
        // echo "<td><a href='show.php?id={$row['id']}'>Details</a> | <a href='delete.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No data available</td></tr>";
}

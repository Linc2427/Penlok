<?php
include 'config.php';

// Ambil ID gambar dari URL
$image_id = intval($_GET['id']); // Pastikan ID aman untuk digunakan dalam query

// Query untuk mengambil informasi gambar berdasarkan ID dari kedua tabel
$query = "
    SELECT REPLACE('Kamera1', 'Kamera1', 'Kamera 1') AS source, image, upload_time
    FROM Kamera1
    WHERE id = $image_id
    UNION ALL
    SELECT REPLACE('Kamera2', 'Kamera2', 'Kamera 2') AS source, image, upload_time
    FROM Kamera2
    WHERE id = $image_id
";

$result = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Image</title>
    <style>
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            border-radius: 10px;
            border-color: black;
            padding: 5px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="card-content">
        <?php
        // Pastikan gambar ditemukan
        if (mysqli_num_rows($result) > 0) {
            $image_data = mysqli_fetch_assoc($result);
            $image_name = $image_data['image']; // Nama file gambar
            $timestamp = $image_data['upload_time'];
            $source = $image_data['source']; // Sumber gambar (images atau images1)

            // ngatur waktu ben local
            $datetime = new DateTime($timestamp);
            $datetime->setTimezone(new DateTimeZone('Asia/Jakarta'));
            $local_time = $datetime->format('d-M-Y H:i:s');

            // Tampilkan gambar
            // echo "<img src='$image_name' alt='Gambar'>";
            // echo "Gambar Terdeteksi Pada : $local_time";

            // echo "<br><a href='index.php'>Kembali</a>";
        } else {
            echo "Gambar tidak ditemukan.";
        }
        ?>
        <img class="img" src="<?= $image_name ?>">
        <div class="text-center">
            Dari Kamera : <b><?= $source ?></b>
        </div>
        <div class="text-center">
            <p>Gambar Terdeteksi Pada : <b><?= $local_time ?></b></p>
        </div>

    </div>
</body>

</html>
<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');


$target_dir = "captured_images/"; // folder untuk menyimpan gambar
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$date = new DateTime();
$date_string = $date->format('Y-m-d_His');
$target_file = $target_dir . $date_string . basename($_FILES["imageFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$file_name = pathinfo($target_file, PATHINFO_BASENAME);

// Check if image file is an actual image or fake image
if (isset($_FILES["imageFile"])) {
    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["imageFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
        // Save file information to database
        $stmt = $conn->prepare("INSERT INTO images (file_name, file_path, upload_time) VALUES (?, ?, ?)");
        $upload_time = $date->format('Y-m-d H:i:s');
        $stmt->bind_param("sss", $file_name, $target_file, $upload_time);

        if ($stmt->execute()) {
            echo "Photo successfully uploaded to server with name " . $file_name;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your photo.";
    }
}

$conn->close();

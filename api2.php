<?php
require 'config.php';

$target_dir = "uploads/";
$datum = mktime(date('H') + 0, date('i'), date('s'), date('m'), date('d'), date('y'));
$target_file = $target_dir . date('Y.m.d_H.i.s_', $datum) . basename($_FILES["imageFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".<br>";
    $uploadOk = 1;
  } else {
    echo "File is not an image.<br>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.<br>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["imageFile"]["size"] > 500000) {
  echo "Sorry, your file is too large.<br>";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.<br>";
} else {
  if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
  }

  if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["imageFile"]["name"]) . " has been uploaded.<br>";

    // Insert file details into database
    $conn = new mysqli($server, $user, $pass, $database);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $filename = basename($_FILES["imageFile"]["name"]);
    $file_path = $target_file;
    $upload_time = date('Y-m-d H:i:s', $datum);

    $sql = "INSERT INTO Kamera2 (image, upload_time) VALUES ('$file_path', '$upload_time')";
    if ($conn->query($sql) === TRUE) {
      echo "File details inserted into database successfully.<br>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
    }

    $conn->close();
  } else {
    echo "Sorry, there was an error uploading your file.<br>";
  }
}

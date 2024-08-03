<?php
// Check connection
require 'config.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imageFile'])) {
    $image = $_FILES['imageFile']['tmp_name'];
    $imgContent = file_get_contents($image);
    
    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO images (image) VALUES (?)");
    $stmt->bind_param("b", $imgContent);
    
    // Send the binary data
    $stmt->send_long_data(0, $imgContent);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo "No image file received";
}

$conn->close();
?>

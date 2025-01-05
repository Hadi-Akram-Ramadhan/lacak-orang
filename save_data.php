<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_POST['image'];
    $location = $_POST['location'];
    
    // Convert base64 ke binary
    $image = str_replace('data:image/jpeg;base64,', '', $image);
    $image = base64_decode($image);
    
    // Save ke database
    $stmt = $conn->prepare("INSERT INTO foto (img, lokasi) VALUES (?, ?)");
    $stmt->bind_param("ss", $image, $location);
    $stmt->execute();
    $stmt->close();
    
    echo "success";
}
?>
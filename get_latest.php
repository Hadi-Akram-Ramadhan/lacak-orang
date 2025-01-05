<?php
require 'koneksi.php';

$query = "SELECT img, lokasi FROM foto ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Convert binary ke base64
$imageBase64 = base64_encode($row['img']);

echo json_encode([
    'image' => $imageBase64,
    'location' => $row['lokasi']
]);
?>
<?php
// config.php
 $host = 'localhost';
 $username = 'root';
 $password = '';
 $database = 'umkm_mpp';

// Create connection
 $conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
 $conn->set_charset("utf8");

// Create uploads directory if not exists
 $uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
?>
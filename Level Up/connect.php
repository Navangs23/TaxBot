<?php
$host = 'localhost';
$port = '3306';
$db   = 'claimwise';
$user = 'root';
$pass = '';

// Create connection with port
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

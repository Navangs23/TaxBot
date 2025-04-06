<?php
include 'session_check.php';  // Start session & apply timeout
include 'connect.php';        // DB connection

$username = $_POST['username'];
$user_id = md5($_POST['user_id']);
$password = md5($_POST['password']); // md5 hash

$sql = "INSERT INTO user (username, user_id, password,created_on) VALUES (?, ?, ?,now())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $user_id, $password);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<?php
include 'session_check.php';  // Start session & apply timeout
include 'connect.php';        // DB connection

$user_id = md5($_POST['user_id']);
$password = md5($_POST['password']);

$sql = "SELECT * FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if ($password === $row['password']) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['last_activity'] = time();
        echo "Login successful! Welcome " . $row['username'];
    } else {
        echo "Invalid password!";
    }
} else {
    echo "User not found!";
}

$stmt->close();
$conn->close();
?>

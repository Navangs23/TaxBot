<?php
    // Start the session
    session_start();

    // Set timeout duration in seconds (e.g., 10 minutes)
    $timeout_duration = 1000;

    // Check for existing session
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
        // Last activity is beyond timeout
        session_unset();     // Unset session variables
        session_destroy();   // Destroy the session
        header("Location: Login 2.html"); // Redirect to login
        exit();
    }

    // Update last activity time
    $_SESSION['LAST_ACTIVITY'] = time();

    // Optional: Check if user is logged in (uncomment if you have login sessions)
    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: login.html");
    //     exit();
    // }
?>

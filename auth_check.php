<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure required session variables are set
if (!isset($_SESSION['first_name']) || !isset($_SESSION['role'])) {
    // If session is incomplete, redirect to login
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

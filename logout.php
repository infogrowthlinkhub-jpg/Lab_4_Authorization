<?php
header("Content-Type: application/json");
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (session_unset() && session_destroy()) {
    echo json_encode(["logout" => true]);
} else {
    echo json_encode(["logout" => false]);
}
?>

<?php
header("Content-Type: application/json");
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "db.php";

// Get JSON input
$input = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($input["email"]) || !isset($input["password"])) {
    echo json_encode(["success" => false, "error" => "Email and password are required"]);
    exit();
}

$email = trim($input["email"]);
$password = $input["password"];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "error" => "Invalid email format"]);
    exit();
}

// Use backticks for table/column names for case-sensitive servers
$sql = "SELECT `id`, `first_name`, `password_hash`, `role` FROM `users` WHERE `email` = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    error_log("Prepare failed: " . $con->error);
    echo json_encode(["success" => false, "error" => "Database error: " . $con->error]);
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Verify password
    if (isset($row["password_hash"]) && password_verify($password, $row["password_hash"])) {
        // Set session variables
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["role"] = isset($row["role"]) ? $row["role"] : "student";

        echo json_encode([
            "success" => true,
            "username" => $row["first_name"],
            "user_id" => $row["id"],
            "role" => $_SESSION["role"]
        ]);
        $stmt->close();
        exit();
    } else {
        error_log("Password verification failed for email: " . $email);
    }
} else {
    error_log("User not found: " . $email);
}

$stmt->close();
echo json_encode(["success" => false, "error" => "Invalid email or password"]);
?>


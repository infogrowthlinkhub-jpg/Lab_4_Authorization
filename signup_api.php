<?php
header("Content-Type: application/json");
require "db.php";

// Get JSON input
$input = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($input["firstname"]) || !isset($input["lastname"]) || !isset($input["email"]) || !isset($input["password"])) {
    echo json_encode(["state" => false, "error" => "Missing required fields"]);
    exit();
}

$fname = trim($input["firstname"]);
$lname = trim($input["lastname"]);
$email = trim($input["email"]);
$password = password_hash($input["password"], PASSWORD_DEFAULT);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["state" => false, "error" => "Invalid email format"]);
    exit();
}

// Use backticks for table/column names for case-sensitive servers
$sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password_hash`) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);

if (!$stmt) {
    error_log("Prepare failed: " . $con->error);
    echo json_encode(["state" => false, "error" => "Database prepare error: " . $con->error]);
    exit();
}

$stmt->bind_param("ssss", $fname, $lname, $email, $password);

if ($stmt->execute()) {
    // Check if row was actually inserted
    if ($stmt->affected_rows > 0) {
        echo json_encode(["state" => true, "message" => "User registered successfully"]);
    } else {
        echo json_encode(["state" => false, "error" => "No rows inserted. User may already exist."]);
    }
} else {
    error_log("Execute failed: " . $stmt->error);
    echo json_encode(["state" => false, "error" => "Database error: " . $stmt->error]);
}

$stmt->close();
?>


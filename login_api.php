<?php
header("Content-Type: application/json");
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "db.php";

$input = json_decode(file_get_contents("php://input"), true);

$email = $input["email"];
$password = $input["password"];

$sql = "SELECT id, first_name, password_hash, role FROM users WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row["password_hash"])) {

        $_SESSION["user_id"] = $row["id"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["role"] = $row["role"];

        echo json_encode([
            "success" => true,
            "username" => $row["first_name"],
            "user_id" => $row["id"]
        ]);
        exit();
    }
}

echo json_encode(["success" => false]);
?>


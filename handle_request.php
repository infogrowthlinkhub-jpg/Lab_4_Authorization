<?php
header("Content-Type: application/json");
require "auth_check.php";
require "db.php";

if ($_SESSION["role"] !== "lecturer") {
    echo json_encode(["success" => false, "error" => "Unauthorized"]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

$request_id = $input["request_id"];
$action = $input["action"]; // "approved" or "rejected"

$sql = "UPDATE course_requests SET status = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("si", $action, $request_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>

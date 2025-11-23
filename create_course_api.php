<?php
header("Content-Type: application/json");
require "auth_check.php";
require "db.php";

if ($_SESSION["role"] !== "lecturer") {
    echo json_encode(["success" => false, "error" => "Unauthorized"]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

$name = $input["course_name"];
$code = $input["course_code"];
$lecturer = $_SESSION["user_id"];

$sql = "INSERT INTO `courses` (`course_name`, `course_code`, `lecturer_id`) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssi", $name, $code, $lecturer);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>


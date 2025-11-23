<?php
header("Content-Type: application/json");
require "auth_check.php";
require "db.php";

$input = json_decode(file_get_contents("php://input"), true);

$course_id = $input["course_id"];
$student_id = $_SESSION["user_id"];

$sql = "INSERT INTO course_requests (course_id, student_id) VALUES (?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $course_id, $student_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>

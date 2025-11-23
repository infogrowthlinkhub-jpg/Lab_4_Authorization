<?php
header("Content-Type: application/json");
require "auth_check.php";
require "db.php";

$lecturer = $_SESSION["user_id"];

$sql = "SELECT cr.`id` AS request_id, u.`first_name`, u.`last_name`, c.`course_name`
        FROM `course_requests` cr
        JOIN `users` u ON cr.`student_id` = u.`id`
        JOIN `courses` c ON cr.`course_id` = c.`id`
        WHERE c.`lecturer_id` = ? AND cr.`status` = 'pending'";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $lecturer);
$stmt->execute();
$result = $stmt->get_result();

$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

echo json_encode($requests);
?>

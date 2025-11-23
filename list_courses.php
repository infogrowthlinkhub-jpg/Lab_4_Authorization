<?php
header("Content-Type: application/json");
require "auth_check.php";
require "db.php";

$sql = "SELECT * FROM `courses`";
$result = $con->query($sql);

$courses = [];
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

echo json_encode($courses);
?>

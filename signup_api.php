<?php
header("Content-Type: application/json");
require "db.php";

$input = json_decode(file_get_contents("php://input"), true);

$fname = $input["firstname"];
$lname = $input["lastname"];
$email = $input["email"];
$password = password_hash($input["password"], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (first_name, last_name, email, password_hash) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssss", $fname, $lname, $email, $password);

if ($stmt->execute()) {
    echo json_encode(["state" => true]);
} else {
    echo json_encode(["state" => false, "error" => $stmt->error]);
}
?>


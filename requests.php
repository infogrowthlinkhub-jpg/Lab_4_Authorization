<?php 
require "auth_check.php"; 

// Only lecturers can view requests
if ($_SESSION["role"] !== "lecturer") {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Requests - Course Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <span>Course Requests</span>
        <div style="float: right;">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="courses.php">Courses</a>
            <a href="create_course.php">Create Course</a>
            <a href="#" onclick="logout(); return false;">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="logout.js"></script>

    <div class="container" style="max-width: 800px;">
        <h2>Course Requests</h2>
        <div id="requestList"></div>
    </div>
    <script src="requests.js"></script>
</body>
</html>


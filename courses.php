<?php 
require "auth_check.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Course Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <span>Available Courses</span>
        <div style="float: right;">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <?php if ($_SESSION["role"] === "lecturer"): ?>
                <a href="create_course.php">Create Course</a>
                <a href="requests.php">Requests</a>
            <?php else: ?>
                <a href="my_courses.php">My Courses</a>
            <?php endif; ?>
            <a href="#" onclick="logout(); return false;">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="logout.js"></script>

    <div class="container" style="max-width: 800px;">
        <h2>Available Courses</h2>
        <div id="courseList"></div>
    </div>
    <script src="list_courses.js"></script>
</body>
</html>


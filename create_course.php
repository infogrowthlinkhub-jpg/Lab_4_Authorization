<?php 
require "auth_check.php"; 

// Only lecturers can create courses
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
    <title>Create Course - Course Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <span>Create Course</span>
        <div style="float: right;">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="courses.php">Courses</a>
            <a href="requests.php">Requests</a>
            <a href="#" onclick="logout(); return false;">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="logout.js"></script>

    <div class="container">
        <h2>Create New Course</h2>
        <form id="courseForm">
            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" required>
            
            <label for="course_code">Course Code:</label>
            <input type="text" id="course_code" name="course_code" required>
            
            <button type="submit">Create Course</button>
        </form>
    </div>
    <script src="create_course.js"></script>
</body>
</html>

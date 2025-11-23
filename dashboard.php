<?php 
require "auth_check.php"; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="navbar">
    <span>Welcome <?php echo htmlspecialchars($_SESSION["first_name"]); ?> (<?php echo htmlspecialchars($_SESSION["role"]); ?>)</span>
    <div style="float: right;">
        <a href="index.php">Home</a>
        <?php if ($_SESSION["role"] === "lecturer"): ?>
            <a href="courses.php">Courses</a>
            <a href="create_course.php">Create Course</a>
            <a href="requests.php">Requests</a>
        <?php else: ?>
            <a href="my_courses.php">My Courses</a>
            <a href="courses.php">Browse Courses</a>
        <?php endif; ?>
        <a href="#" onclick="logout(); return false;">Logout</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="logout.js"></script>

<div class="container" style="max-width: 1000px; width: auto;">
    <h2>Dashboard</h2>
    
    <?php if ($_SESSION["role"] === "lecturer"): ?>
        <!-- Faculty Dashboard -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px;">
            <div class="card">
                <h3 style="color: #0A66C2; margin-top: 0;">📚 My Courses</h3>
                <p>View and manage your courses</p>
                <a href="courses.php" style="color: #0A66C2; text-decoration: none;">View Courses →</a>
            </div>
            
            <div class="card">
                <h3 style="color: #0A66C2; margin-top: 0;">➕ Create Course</h3>
                <p>Create a new course</p>
                <a href="create_course.php" style="color: #0A66C2; text-decoration: none;">Create Course →</a>
            </div>
            
            <div class="card">
                <h3 style="color: #0A66C2; margin-top: 0;">📋 Requests</h3>
                <p>View and handle student requests</p>
                <a href="requests.php" style="color: #0A66C2; text-decoration: none;">View Requests →</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Student Dashboard -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px;">
            <div class="card">
                <h3 style="color: #0A66C2; margin-top: 0;">📚 My Enrolled Courses</h3>
                <p>View courses you are enrolled in</p>
                <a href="my_courses.php" style="color: #0A66C2; text-decoration: none;">View My Courses →</a>
            </div>
            
            <div class="card">
                <h3 style="color: #0A66C2; margin-top: 0;">🔍 Browse Courses</h3>
                <p>Search and join available courses</p>
                <a href="courses.php" style="color: #0A66C2; text-decoration: none;">Browse Courses →</a>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

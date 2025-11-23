<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Redirect to dashboard if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .hero {
            text-align: center;
            padding: 100px 20px;
            background: linear-gradient(135deg, #0A66C2 0%, #004a99 100%);
            color: white;
            margin-bottom: 50px;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 20px;
            margin-bottom: 40px;
        }
        .button-group {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-primary, .btn-secondary {
            padding: 15px 40px;
            font-size: 18px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-primary {
            background: white;
            color: #0A66C2;
        }
        .btn-primary:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        .features {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .feature-card h3 {
            color: #0A66C2;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="navbar">
        <span>Course Management System</span>
        <div style="float: right;">
            <a href="dashboard.php">Dashboard</a>
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
    <?php endif; ?>
    <div class="hero">
        <h1>Welcome to Course Management System</h1>
        <p>Manage your courses, track attendance, and connect with students</p>
        <div class="button-group">
            <a href="login.php" class="btn-primary">Login</a>
            <a href="signup.php" class="btn-secondary">Sign Up</a>
        </div>
    </div>

    <div class="features">
        <div class="feature-card">
            <h3>📚 Course Management</h3>
            <p>Create and manage your courses with ease. Organize your teaching materials and track student progress.</p>
        </div>
        <div class="feature-card">
            <h3>👥 Student Requests</h3>
            <p>Handle student enrollment requests efficiently. Approve or reject requests with a single click.</p>
        </div>
        <div class="feature-card">
            <h3>✅ Attendance Tracking</h3>
            <p>Keep track of student attendance and maintain detailed records for each course.</p>
        </div>
    </div>
</body>
</html>


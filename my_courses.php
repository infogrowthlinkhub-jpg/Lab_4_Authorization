<?php 
require "auth_check.php"; 

// Only students can view their enrolled courses
if ($_SESSION["role"] !== "student") {
    header("Location: dashboard.php");
    exit();
}

require "db.php";

// Get enrolled courses for the student
$student_id = $_SESSION["user_id"];
$sql = "SELECT c.id, c.course_name, c.course_code, c.created_at 
        FROM courses c
        INNER JOIN course_requests cr ON c.id = cr.course_id
        WHERE cr.student_id = ? AND cr.status = 'approved'";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Course Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <span>My Enrolled Courses</span>
        <div style="float: right;">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="courses.php">Browse Courses</a>
            <a href="#" onclick="logout(); return false;">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="logout.js"></script>

    <div class="container" style="max-width: 800px;">
        <h2>My Enrolled Courses</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Enrolled Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #666; margin-top: 20px;">You are not enrolled in any courses yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>


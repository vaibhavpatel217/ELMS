<?php
session_start();
/*
// Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    echo "<script>alert('Please login as admin to access this page.'); window.location='admin_login.php';</script>";
    exit();
}*/

$con = new mysqli("localhost", "root", "", "elearning1");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request'); window.location='admin_watch.php';</script>";
    exit();
}

$id = intval($_GET['id']);

// Update record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $con->real_escape_string($_POST['student_name']);
    $course_id = intval($_POST['course_id']); // must be valid ID from courses
    $watched_at = $con->real_escape_string($_POST['watched_at']);

    // also fetch course_name from courses to keep consistency
    $course_res = $con->query("SELECT course_name FROM courses WHERE id=$course_id");
    if ($course_res->num_rows == 0) {
        echo "<script>alert('Invalid Course ID selected'); window.location='edit_watch.php?id=$id';</script>";
        exit();
    }
    $course_data = $course_res->fetch_assoc();
    $course_name = $con->real_escape_string($course_data['course_name']);

    $sql = "UPDATE watch 
            SET student_name='$student_name', course_id=$course_id, 
                course_name='$course_name', watched_at='$watched_at' 
            WHERE id=$id";

    if ($con->query($sql)) {
        echo "<script>alert('Record updated successfully'); window.location='admin_watch.php';</script>";
        exit();
    } else {
        echo "Error: " . $con->error;
    }
}

// Fetch record details
$result = $con->query("SELECT * FROM watch WHERE id=$id");
if ($result->num_rows == 0) {
    echo "<script>alert('Record not found'); window.location='admin_watch.php';</script>";
    exit();
}
$row = $result->fetch_assoc();

// Fetch all courses for dropdown
$courses = $con->query("SELECT id, course_name FROM courses ORDER BY course_name ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Watch Record</title>
     <?php
    include_once('includes/style.php');
    ?></head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Watch Record</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" name="student_name" class="form-control" 
                       value="<?php echo htmlspecialchars($row['student_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <select name="course_id" class="form-control" required>
                    <?php
                    if ($courses && $courses->num_rows > 0) {
                        while ($c = $courses->fetch_assoc()) {
                            $selected = ($c['id'] == $row['course_id']) ? "selected" : "";
                            echo "<option value='{$c['id']}' $selected>{$c['id']} - {$c['course_name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Watched At</label>
                <input type="datetime-local" name="watched_at" class="form-control" 
                       value="<?php echo date('Y-m-d\TH:i', strtotime($row['watched_at'])); ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="admin_watch.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

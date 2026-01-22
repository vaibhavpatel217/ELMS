<?php
$con = new mysqli("localhost", "root", "", "elearning1");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>alert('Invalid course ID'); window.location='admin_view_courses.php';</script>";
    exit;
}

$con->query("DELETE FROM courses WHERE id = $id");

echo "<script>alert('Course deleted successfully'); window.location='admin_course.php';</script>";

?>
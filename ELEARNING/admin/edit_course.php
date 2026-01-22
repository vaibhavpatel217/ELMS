<?php
$con = new mysqli("localhost", "root", "", "elearning1");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Invalid course ID.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $course_type = $_POST['course_type'];
    $time_duration = $_POST['time_duration'];
    $author = $_POST['author'];
    $is_popular = isset($_POST['is_popular']) ? 1 : 0;
    $video_url = $_POST['video_url'];

    $stmt = $con->prepare("UPDATE courses SET course_name=?, course_type=?, time_duration=?, author=?,is_popular=?, video_url=? WHERE id=?");
    $stmt->bind_param("ssssisi", $course_name, $course_type, $time_duration,$author, $is_popular, $video_url, $id);
    $stmt->execute();

    echo "<script>alert('Course updated successfully'); window.location='admin_course.php';</script>";
    exit;
}

$result = $con->query("SELECT * FROM courses WHERE id = $id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Course</title>
 <?php
    include_once('includes/style.php');
    ?>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Course</h2>
        <form method="post">
            <div class="mb-3">
                <label>Course Name</label>
                <input type="text" name="course_name" class="form-control" value="<?= $row['course_name'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Course Type</label>
                <input type="text" name="course_type" class="form-control" value="<?= $row['course_type'] ?>">
            </div>
            <div class="mb-3">
                <label>Time Duration</label>
                <input type="text" name="time_duration" class="form-control" value="<?= $row['time_duration'] ?>">
            </div>
            <div class="mb-3">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="<?= $row['author'] ?>">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_popular" class="form-check-input" <?= $row['is_popular'] ? 'checked' : '' ?>>
                <label class="form-check-label">Mark as Popular</label>
            </div>
            <div class="mb-3">
                <label>Video URL</label>
                <input type="text" name="video_url" class="form-control" value="<?= $row['video_url'] ?>">
            </div>
            <button type="submit" class="btn btn-success">Update Course</button>
            <a href="admin_course.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

</body>
</html>
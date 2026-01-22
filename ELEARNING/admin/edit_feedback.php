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
    echo "<script>alert('Invalid request'); window.location='admin_feedback.php';</script>";
    exit();
}

$id = intval($_GET['id']);

// Update feedback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $con->real_escape_string($_POST['student_name']);
    $email = $con->real_escape_string($_POST['email']);
    $feedback_text = $con->real_escape_string($_POST['feedback_text']);

    $sql = "UPDATE feedback SET student_name='$student_name', email='$email', feedback_text='$feedback_text' WHERE id=$id";
    if ($con->query($sql)) {
        echo "<script>alert('Feedback updated successfully'); window.location='admin_feedback.php';</script>";
        exit();
    } else {
        echo "Error: " . $con->error;
    }
}

// Fetch feedback details
$result = $con->query("SELECT * FROM feedback WHERE id=$id");
if ($result->num_rows == 0) {
    echo "<script>alert('Feedback not found'); window.location='admin_feedback.php';</script>";
    exit();
}
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Feedback</title>
     <?php
    include_once('includes/style.php');
    ?>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Feedback</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" name="student_name" class="form-control" value="<?php echo htmlspecialchars($row['student_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Feedback</label>
                <textarea name="feedback_text" class="form-control" rows="4" required><?php echo htmlspecialchars($row['feedback_text']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="admin_feedback.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

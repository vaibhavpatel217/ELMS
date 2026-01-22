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
    echo "<script>alert('Invalid request'); window.location='admin_students.php';</script>";
    exit();
}

$id = intval($_GET['id']);

// Update student
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $con->real_escape_string($_POST['student_name']);
    $email = $con->real_escape_string($_POST['email']);
    $city = $con->real_escape_string($_POST['city']);
    $mobile = $con->real_escape_string($_POST['mobile']);

    $sql = "UPDATE students SET student_name='$student_name', email='$email', city='$city', mobile='$mobile' WHERE id=$id";

    if ($con->query($sql)) {
        echo "<script>alert('Student updated successfully'); window.location='admin_students.php';</script>";
        exit();
    } else {
        echo "Error: " . $con->error;
    }
}

// Fetch student details
$result = $con->query("SELECT * FROM students WHERE id=$id");
if ($result->num_rows == 0) {
    echo "<script>alert('Student not found'); window.location='admin_students.php';</script>";
    exit();
}
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
     <?php
    include_once('includes/style.php');
    ?>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Student</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" name="student_name" class="form-control" 
                       value="<?php echo htmlspecialchars($row['student_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" 
                       value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" 
                       value="<?php echo htmlspecialchars($row['city']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile" class="form-control" 
                       value="<?php echo htmlspecialchars($row['mobile']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="admin_students.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

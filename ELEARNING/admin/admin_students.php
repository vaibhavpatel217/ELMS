<?php
session_start();
/*
// Uncomment to enforce admin login
if (!isset($_SESSION['admin_username'])) {
    echo "<script>alert('Please login as admin to access this page.'); window.location='admin_login.php';</script>";
    exit();
}*/

// Database connection
$con = new mysqli("localhost", "root", "", "elearning1");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Delete student
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $con->query("DELETE FROM students WHERE id=$delete_id");
    echo "<script>alert('Student deleted successfully'); window.location='admin_students.php';</script>";
    exit();
}

// Fetch student data
$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Students</title>
    <?php include_once('includes/style.php'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Header -->
    <?php include_once('includes/header.php'); ?>

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php'); ?>

    <!-- ================= START: Main Content Wrapper ================= -->
    <div class="content-wrapper">

        <!-- Page Header -->
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="text-primary">Registered Students</h1>
            </div>
        </section>

        <!-- ================= START: Page Content ================= -->
        <section class="content">
            <div class="container-fluid">

                <!-- Students Card -->
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title text-white">Students List</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                                            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                                            <td>
                                                <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">✏ Edit</a>
                                                <a href="admin_students.php?delete_id=<?php echo $row['id']; ?>" 
                                                   class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this student?');">
                                                   🗑 Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No students found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="dashboard.php" class="btn btn-primary">⬅ Back to Home</a>
                    </div>
                </div>

            </div>
        </section>
        <!-- ================= END: Page Content ================= -->

    </div>
    <!-- ================= END: Main Content Wrapper ================= -->

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

    <!-- Right Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<?php include_once('includes/script.php'); ?>
</body>
</html>

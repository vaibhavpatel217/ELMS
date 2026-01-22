<?php
session_start();
/*
// Optional: Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    echo "<script>alert('Please login as admin to access this page.'); window.location='admin_login.php';</script>";
    exit();
}
*/

// Database connection
$con = new mysqli("localhost", "root", "", "elearning1");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Delete feedback
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $con->query("DELETE FROM feedback WHERE id=$delete_id");
    echo "<script>alert('Feedback deleted successfully'); window.location='admin_feedback.php';</script>";
    exit();
}

// Fetch feedback data
$sql    = "SELECT * FROM feedback ORDER BY submitted_at DESC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Student Feedback</title>
  <?php include_once('includes/style.php'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include_once('includes/header.php'); ?>

  <!-- Sidebar -->
  <?php include_once('includes/sidebar.php'); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>📝 Student Feedback</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Feedback</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card">
          <div class="card-header bg-dark">
            <h3 class="card-title text-white">Feedback List</h3>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Feedback</th>
                  <th>Submitted At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?= $row['id'] ?></td>
                      <td><?= htmlspecialchars($row['student_name']) ?></td>
                      <td><?= htmlspecialchars($row['email']) ?></td>
                      <td><?= nl2br(htmlspecialchars($row['feedback_text'])) ?></td>
                      <td><?= date("d M Y, h:i A", strtotime($row['submitted_at'])) ?></td>
                      <td>
                        <a href="edit_feedback.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏ Edit</a>
                        <a href="admin_feedback.php?delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this feedback?');">🗑 Delete</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No feedback found</td>
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

  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <?php include_once('includes/footer.php'); ?>

</div>
<!-- ./wrapper -->

<?php include_once('includes/script.php'); ?>
</body>
</html>

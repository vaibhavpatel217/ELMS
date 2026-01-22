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

// Delete record
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $con->query("DELETE FROM watch WHERE id=$delete_id");
    echo "<script>alert('Record deleted successfully'); window.location='admin_watch.php';</script>";
    exit();
}

// Fetch watch table data
$sql = "SELECT * FROM watch ORDER BY watched_at DESC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Watch History</title>
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
            <h1>🎬 Course Watch History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Watch History</li>
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
            <h3 class="card-title text-white">Watch Records</h3>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Student Name</th>
                  <th>Course ID</th>
                  <th>Course Name</th>
                  <th>Watched At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?= $row['id'] ?></td>
                      <td><?= htmlspecialchars($row['student_name']) ?></td>
                      <td><?= $row['course_id'] ?></td>
                      <td><?= htmlspecialchars($row['course_name']) ?></td>
                      <td><?= date("d M Y, h:i A", strtotime($row['watched_at'])) ?></td>
                      <td>
                        <a href="edit_watch.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏ Edit</a>
                        <a href="admin_watch.php?delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this record?');">🗑 Delete</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No records found.</td>
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

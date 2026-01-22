<?php
session_start();

// Database connection
$con = new mysqli("localhost", "root", "", "elearning1");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch all courses
$sql    = "SELECT * FROM courses ORDER BY id DESC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | Courses</title>
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
            <h1>📚 Courses Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Courses</li>
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
            <h3 class="card-title text-white">Courses List</h3>
            <a href="add_course.php" class="btn btn-success float-right">➕ Add New Course</a>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Course Name</th>
                  <th>Type</th>
                  <th>Duration</th>
                  <th>Author</th>
                  <th>Popular</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?= $row['id'] ?></td>
                      <td><?= htmlspecialchars($row['course_name']) ?></td>
                      <td><?= htmlspecialchars($row['course_type']) ?></td>
                      <td><?= htmlspecialchars($row['time_duration']) ?></td>
                      <td><?= htmlspecialchars($row['author']) ?></td>
                      
                      <td><?= $row['is_popular'] ? 'Yes' : 'No' ?></td>
                      <td>
                        <a href="edit_course.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏ Edit</a>
                        <a href="delete_course.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this course?');">🗑 Delete</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No courses found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-center">
            <a href="dashboard.php" class="btn btn-secondary">⬅ Back to Home</a>
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

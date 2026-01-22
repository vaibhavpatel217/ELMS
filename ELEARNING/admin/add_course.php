<?php
// Database connection
$con = new mysqli("localhost", "root", "", "elearning1");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name   = $_POST['course_name'];
    $course_type   = $_POST['course_type'];
    $time_duration = $_POST['time_duration'];
    $author = $_POST['author'];
    $is_popular    = isset($_POST['is_popular']) ? 1 : 0;

    $video_url     = $_POST['video_url'];

    $stmt = $con->prepare("INSERT INTO courses (course_name, course_type, time_duration,author, is_popular, video_url) 
                           VALUES (?, ?, ?, ?,?, ?)");
    $stmt->bind_param("ssssis", $course_name, $course_type, $time_duration,$author, $is_popular, $video_url);
    $stmt->execute();

    echo "<script>alert('New course added successfully'); window.location='admin_course.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Course | AdminLTE</title>
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
        <h1 class="text-primary">Add New Course</h1>
      </div>
    </section>

    <!-- Page Content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card">
          <div class="card-header bg-dark">
            <h3 class="card-title text-white">Course Form</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Course Name</label>
                <input type="text" name="course_name" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Course Type</label>
                <input type="text" name="course_type" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Time Duration</label>
                <input type="text" name="time_duration" class="form-control">
              </div>
              
              <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control">
              </div>

              <div class="form-check mb-3">
                <input type="checkbox" name="is_popular" class="form-check-input" id="popular">
                <label for="popular" class="form-check-label">Mark as Popular</label>
              </div>

              <div class="mb-3">
                <label class="form-label">Video URL</label>
                <input type="text" name="video_url" class="form-control">
              </div>

              <button type="submit" class="btn btn-success">Add Course</button>
              <a href="admin_course.php" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>

      </div>
    </section>

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

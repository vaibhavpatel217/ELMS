<?php
include_once('includes/config.php');  // Include your DB connection

// Get counts from database
// 1. Courses count
$result = $conn->query("SELECT COUNT(*) AS total_courses FROM courses");
$courses = $result->fetch_assoc()['total_courses'] ?? 0;

// 2. Course Categories count
$result = $conn->query("SELECT COUNT(*) AS total_categories FROM course_categories");
$categories = $result->fetch_assoc()['total_categories'] ?? 0;

// 3. Watch Rate (Assuming you have some table or logic for watch rate, here static)
$watch_rate = 80;  // You can change this logic based on your actual table/data

// 4. User Registrations
$result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$users = $result->fetch_assoc()['total_users'] ?? 0;

// 5. Feedback count
$result = $conn->query("SELECT COUNT(*) AS total_feedback FROM feedback");
$feedback = $result->fetch_assoc()['total_feedback'] ?? 0;

// 6. Subscribers count
$result = $conn->query("SELECT COUNT(*) AS total_subscribers FROM subscribers");
$subscribers = $result->fetch_assoc()['total_subscribers'] ?? 0;

// 7. Contact Queries count
$result = $conn->query("SELECT COUNT(*) AS total_queries FROM contact_queries");
$queries = $result->fetch_assoc()['total_queries'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  <?php include_once('includes/style.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include_once('includes/header.php'); ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $courses; ?></h3>
                  <p>Maintain Course</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book nav-icon"></i>
                </div>
                <a href="admin_course.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $categories; ?></h3>
                  <p>Course Categories</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="admin_course_categories.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $watch_rate; ?><sup style="font-size: 20px">%</sup></h3>
                  <p>Watch Rate</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-line nav-icon"></i>
                </div>
                <a href="admin_watch.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $users; ?></h3>
                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="admin_students.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo $feedback; ?></h3>
                  <p>Feedback</p>
                </div>
                <div class="icon">
                  <i class="fas fa-comments nav-icon"></i>
                </div>
                <a href="admin_feedback.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-olive">
                <div class="inner">
                  <h3><?php echo $subscribers; ?></h3>
                  <p>Subscribers</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="admin_view-subscribers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $queries; ?></h3>
                  <p>Contact Query</p>
                </div>
                <div class="icon">
                  <i class="fa fa-question-circle"></i>
                </div>
                <a href="admin_contact.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>

    <?php include_once('includes/footer.php'); ?>
    <?php include_once('includes/sidebar.php'); ?>
  </div>

  <?php include_once('includes/script.php'); ?>

</body>
</html>

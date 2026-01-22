<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <?php
  include_once('includes/style.php');
  ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader (Logo while page loads) -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Top Navigation Bar / Header -->
    <?php include_once('includes/header.php'); ?>

    <!-- Sidebar Menu -->
    <?php include_once('includes/sidebar.php'); ?>

    <!-- ================= START: Main Content Wrapper ================= -->
    <div class="content-wrapper">

      <!-- ================= START: Page Content ================= -->
      <!-- 👉 Add your page content / dashboard / forms here -->

      <!-- ================= END: Page Content ================= -->

    </div>
    <!-- ================= END: Main Content Wrapper ================= -->

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

    <!-- Right Sidebar (Optional) -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- You can add extra settings or controls here -->
    </aside>

  </div>
  <!-- ./wrapper -->

  <?php
  include_once('includes/script.php');
  ?>

</body>

</html>
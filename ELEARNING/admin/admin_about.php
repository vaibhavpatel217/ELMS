<?php
session_start();
include_once("../includes/config.php"); // database connection

$about_id = 1; // default about page
$msg = "";

// Handle form submit
if (isset($_POST['update_about'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description1 = $_POST['description1'];
    $description2 = $_POST['description2'];

    // Image upload
    $target_dir = __DIR__ . "/dist/img/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if ($_FILES['image']['name'] != "") {
        $image_name = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = "admin/dist/img/" . $image_name;
            $img_sql = ", image='$image'";
        } else {
            $img_sql = "";
            echo "Failed to move uploaded file!";
        }
    } else {
        $img_sql = "";
    }

    // Update about_page table
    mysqli_query($conn, "UPDATE about_page 
                         SET title='$title', subtitle='$subtitle', description1='$description1', description2='$description2' $img_sql 
                         WHERE id=$about_id");

    // Update features
    if (isset($_POST['features'])) {
        mysqli_query($conn, "DELETE FROM about_features WHERE about_id=$about_id");
        foreach ($_POST['features'] as $feature) {
            $feature = trim($feature);
            if (!empty($feature)) {
                mysqli_query($conn, "INSERT INTO about_features (about_id, feature_text) VALUES ($about_id, '$feature')");
            }
        }
    }

    $msg = "About page updated successfully!";
}

// Fetch current data
$about = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_page WHERE id=$about_id"));
$features_result = mysqli_query($conn, "SELECT * FROM about_features WHERE about_id=$about_id");
$features = [];
while ($row = mysqli_fetch_assoc($features_result)) {
    $features[] = $row['feature_text'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit About Page | AdminLTE</title>
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
        <h1 class="text-primary">Edit About Page</h1>
      </div>
    </section>

    <!-- Page Content -->
    <section class="content">
      <div class="container-fluid">

        <?php if ($msg) { ?>
          <div class="alert alert-success"><?php echo $msg; ?></div>
        <?php } ?>

        <div class="card">
          <div class="card-header bg-dark">
            <h3 class="card-title text-white">About Page Form</h3>
          </div>
          <div class="card-body">

            <form method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($about['title']); ?>" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" value="<?php echo htmlspecialchars($about['subtitle']); ?>" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Description 1</label>
                <textarea name="description1" class="form-control" rows="3"><?php echo htmlspecialchars($about['description1']); ?></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label">Description 2</label>
                <textarea name="description2" class="form-control" rows="3"><?php echo htmlspecialchars($about['description2']); ?></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label">Features</label>
                <div id="features-list">
                  <?php foreach ($features as $f) { ?>
                    <div class="input-group mb-2 feature-item">
                      <input type="text" name="features[]" value="<?php echo htmlspecialchars($f); ?>" class="form-control">
                      <button type="button" class="btn btn-danger" onclick="deleteFeature(this)">Delete</button>
                    </div>
                  <?php } ?>
                  <div class="input-group mb-2 feature-item">
                    <input type="text" name="features[]" placeholder="Add new feature" class="form-control">
                    <button type="button" class="btn btn-danger" onclick="deleteFeature(this)">Delete</button>
                  </div>
                </div>
                <button type="button" class="btn btn-info mt-2" onclick="addFeature()">+ Add Feature</button>
              </div>

              <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                <?php if (!empty($about['image'])) { ?>
                  <img src="<?php echo $about['image']; ?>" width="150" class="mt-2 img-thumbnail">
                <?php } ?>
              </div>

              <button type="submit" name="update_about" class="btn btn-success">Update About Page</button>
              <a href="dashboard.php" class="btn btn-secondary">Back to Home</a>
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

<script>
  function addFeature() {
    var container = document.getElementById('features-list');
    var div = document.createElement('div');
    div.className = 'input-group mb-2 feature-item';
    div.innerHTML = '<input type="text" name="features[]" placeholder="Add new feature" class="form-control"> <button type="button" class="btn btn-danger" onclick="deleteFeature(this)">Delete</button>';
    container.appendChild(div);
  }

  function deleteFeature(button) {
    button.closest('.feature-item').remove();
  }
</script>
</body>
</html>

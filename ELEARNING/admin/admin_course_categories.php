<?php
session_start();
include_once("../includes/config.php"); // DB connection

$msg = "";

/* -------------------------------
   Add Category
---------------------------------*/
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $link = $_POST['link'];

    // Upload image
    $imageName = $_FILES['image']['name'];
    $tmpName   = $_FILES['image']['tmp_name'];
    $target    = "admin/dist/img/" . $imageName;

    if (!empty($imageName)) {
        if (!is_dir("admin/dist/img/")) mkdir("admin/dist/img/", 0777, true);

        if (move_uploaded_file($tmpName, $target)) {
            $conn->query("INSERT INTO course_categories (name, image, link) 
                          VALUES ('$name', 'admin/dist/img/$imageName', '$link')");
            $msg = "✅ Category added successfully!";
        } else $msg = "❌ Failed to upload image.";
    } else $msg = "⚠ Please upload an image.";
}

/* -------------------------------
   Delete Category
---------------------------------*/
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM course_categories WHERE id=$id");
    $msg = "🗑 Category deleted successfully!";
}

/* -------------------------------
   Update Category
---------------------------------*/
if (isset($_POST['update'])) {
    $id   = $_POST['id'];
    $name = $_POST['name'];
    $link = $_POST['link'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $tmpName   = $_FILES['image']['tmp_name'];
        $target    = "admin/dist/img/" . $imageName;
        if (!is_dir("admin/dist/img/")) mkdir("admin/dist/img/", 0777, true);

        if (move_uploaded_file($tmpName, $target)) {
            $conn->query("UPDATE course_categories 
                          SET name='$name', link='$link', image='admin/dist/img/$imageName' 
                          WHERE id=$id");
        } else $msg = "❌ Failed to upload image!";
    } else {
        $conn->query("UPDATE course_categories 
                      SET name='$name', link='$link' 
                      WHERE id=$id");
    }

    $msg = "✅ Category updated successfully!";
}

/* -------------------------------
   Fetch All Categories
---------------------------------*/
$catQuery = $conn->query("SELECT * FROM course_categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Manage Categories</title>
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
                        <h1>📂 Manage Course Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Alert Messages -->
                <?php if ($msg) { ?>
                    <div class="alert alert-info alert-dismissible fade show">
                        <?= $msg ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php } ?>

                <!-- Add New Category -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">➕ Add New Category</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="link" class="form-control" placeholder="Page Link" required>
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" name="add" class="btn btn-success w-100">➕ Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories Table -->
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title">📋 Categories List</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Page Link</th>
                                    <th width="220">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($cat = $catQuery->fetch_assoc()) { ?>
                                    <tr>
                                        <td><img src="../<?= $cat['image'] ?>" width="80" class="rounded"></td>
                                        <td><?= $cat['name'] ?></td>
                                        <td><?= $cat['link'] ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?= $cat['id'] ?>">✏ Edit</button>
                                            <!-- Delete Button -->
                                            <a href="?delete=<?= $cat['id'] ?>" class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure to delete this category?')">🗑 Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?= $cat['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                                                        <div class="mb-3">
                                                            <label>Category Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                   value="<?= $cat['name'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Page Link</label>
                                                            <input type="text" name="link" class="form-control"
                                                                   value="<?= $cat['link'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Image (Upload new if you want to change)</label>
                                                            <input type="file" name="image" class="form-control">
                                                            <img src="../<?= $cat['image'] ?>" width="80" class="mt-2 rounded">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="update" class="btn btn-success">💾 Update</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="dashboard.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

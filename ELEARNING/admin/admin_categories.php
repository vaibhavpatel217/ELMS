<?php
session_start();
include_once("../includes/config.php"); // DB Connection

$msg = "";

/* -------------------------------
   Handle Add New Category
-------------------------------- */
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $link = $_POST['link'];

    // Upload Image
    $imageName = $_FILES['image']['name'];
    $tmpName   = $_FILES['image']['tmp_name'];
    $target    = "../uploads/" . $imageName;

    if (move_uploaded_file($tmpName, $target)) {
        $conn->query("INSERT INTO course_categories (name, image, link) 
                      VALUES ('$name', 'uploads/$imageName', '$link')");
        $msg = "✅ Category added successfully!";
    } else {
        $msg = "❌ Failed to upload image.";
    }
}

/* -------------------------------
   Handle Delete Category
-------------------------------- */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM course_categories WHERE id=$id");
    $msg = "🗑️ Category deleted successfully!";
}

/* -------------------------------
   Fetch All Categories
-------------------------------- */
$catQuery = $conn->query("SELECT * FROM course_categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Course Categories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">📂 Manage Course Categories</h2>

    <!-- Success / Error Message -->
    <?php if ($msg) { ?>
        <div class="alert alert-info"><?php echo $msg; ?></div>
    <?php } ?>

    <!-- Add New Category Form -->
    <form method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="Category Name" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="link" class="form-control" placeholder="Page Link (ex: development.php)" required>
            </div>
            <div class="col-md-3">
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" name="add" class="btn btn-success">➕ Add Category</button>
            </div>
        </div>
    </form>

    <!-- Categories Table -->
    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Category Name</th>
                <th>Page Link</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($cat = $catQuery->fetch_assoc()) { ?>
            <tr>
                <td><img src="../<?php echo $cat['image']; ?>" width="80" class="img-thumbnail"></td>
                <td><?php echo $cat['name']; ?></td>
                <td><?php echo $cat['link']; ?></td>
                <td>
                    <a href="?delete=<?php echo $cat['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this category?')">
                       🗑️ Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

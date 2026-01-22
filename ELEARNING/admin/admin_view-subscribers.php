<?php
session_start();
include_once("includes/config.php"); // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Newsletter Subscribers</title>
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
                        <h1>📧 Newsletter Subscribers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Subscribers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <?php
                // Fetch subscribers
                $result = $conn->query("SELECT * FROM subscribers ORDER BY subscribed_at DESC");
                ?>

                <!-- Subscribers Table -->
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title">Subscribers List</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Subscribed At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td><?= date("d M Y, h:i A", strtotime($row['subscribed_at'])) ?></td>
                                            <td>
                                                <a href="delete-subscriber.php?id=<?= $row['id'] ?>" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Are you sure you want to delete this subscriber?');">
                                                   🗑 Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No subscribers found.</td>
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

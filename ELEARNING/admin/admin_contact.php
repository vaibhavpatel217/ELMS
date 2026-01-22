<?php
session_start();
include_once("includes/config.php"); // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Contact Queries</title>
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
                        <h1>📩 Contact Queries</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Contact Queries</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Success / Error Messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php
                // Fetch contact queries
                $result = mysqli_query($conn, "SELECT * FROM contact_queries ORDER BY created_at DESC");
                if (mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                        <!-- Contact Query Card -->
                        <div class="card mb-3 shadow">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-user"></i> <?= htmlspecialchars($row['student_name']) ?></span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?= date("d M Y, h:i A", strtotime($row['created_at'])) ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Email:</strong></p>
                                        <p><i class="fas fa-envelope text-primary"></i> <?= htmlspecialchars($row['email']) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Subject:</strong></p>
                                        <p><i class="fas fa-tag text-success"></i> <?= htmlspecialchars($row['subject']) ?></p>
                                    </div>
                                </div>
                                <p class="mb-1"><strong>Message:</strong></p>
                                <div class="alert alert-light border rounded">
                                    <?= nl2br(htmlspecialchars($row['message'])) ?>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <a href="edit_contact.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="delete_contact.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this query?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                else:
                    echo "<div class='alert alert-info'><i class='fas fa-info-circle'></i> No contact queries found.</div>";
                endif;
                ?>

                <!-- Back to Home -->
                <div class="text-center mt-3">
                    <a href="dashboard.php" class="btn btn-primary">⬅ Back to Home</a>
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

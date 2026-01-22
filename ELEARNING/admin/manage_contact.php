<?php
session_start();
include_once("../includes/config.php"); // Database connection

$msg = "";

// Handle form submit
if (isset($_POST['update_contact'])) {
    foreach ($_POST['contact'] as $type => $value) {
        $type = $conn->real_escape_string($type);
        $value = $conn->real_escape_string($value);
        $conn->query("UPDATE contact_info SET value='$value' WHERE type='$type'");
    }
    $msg = "✅ Contact information updated successfully!";
}

// Fetch current contact info
$contactQuery = $conn->query("SELECT * FROM contact_info");
$contacts = [];
while ($row = $contactQuery->fetch_assoc()) {
    $contacts[$row['type']] = $row['value'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Manage Contact Info</title>
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
                            <h1>📞 Manage Contact Information</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Contact Info</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Alert Messages -->
                    <?php if ($msg): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= $msg ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Contact Form -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Update Contact Information</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="office" class="form-label">Office</label>
                                    <input type="text" id="office" name="contact[Office]" class="form-control"
                                        value="<?= htmlspecialchars($contacts['Office'] ?? '') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" id="mobile" name="contact[Mobile]" class="form-control"
                                        value="<?= htmlspecialchars($contacts['Mobile'] ?? '') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="contact[Email]" class="form-control"
                                        value="<?= htmlspecialchars($contacts['Email'] ?? '') ?>" required>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" name="update_contact" class="btn btn-success">💾
                                        Update</button>
                                    <a href="dashboard.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
                                </div>
                            </form>
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
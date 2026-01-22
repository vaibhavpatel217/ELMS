<?php
session_start();
include_once("includes/config.php"); // Database connection

// Optional: Check if admin is logged in
// if (!isset($_SESSION['admin_username'])) {
//     echo "<script>alert('Please login as admin'); window.location='admin_login.php';</script>";
//     exit();
// }

// Fetch subscribers
$result = $conn->query("SELECT * FROM subscribers ORDER BY subscribed_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📧 Newsletter Subscribers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">📧 Newsletter Subscribers</h2>

    <?php if ($result && $result->num_rows > 0): ?>
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
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['subscribed_at']) ?></td>
                        <td>
                            <a href="delete-subscriber.php?id=<?= $row['id'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this subscriber?');">
                               🗑 Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center">
            No subscribers found.
        </div>
    <?php endif; ?>

    <div class="text-center mt-3">
        <a href="dashboard.php" class="btn btn-primary">⬅ Back to Dashboard</a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

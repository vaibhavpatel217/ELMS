<?php
session_start();
include_once("includes/config.php"); // DB connection

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_contact.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch existing data
$query = mysqli_query($conn, "SELECT * FROM contact_queries WHERE id = $id");
if (mysqli_num_rows($query) == 0) {
    echo "<div class='alert alert-danger'>Query not found!</div>";
    exit();
}
$data = mysqli_fetch_assoc($query);

// Update record if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $update = mysqli_query($conn, "UPDATE contact_queries 
                                   SET subject = '$subject', message = '$message' 
                                   WHERE id = $id");

    if ($update) {
        $_SESSION['success'] = "Contact query updated successfully!";
        header("Location: admin_contact.php");
        exit();
    } else {
        $error = "Failed to update query. Please try again.";
    }
}

?>

 <?php
    include_once('includes/style.php');
    ?>
<div class="container mt-4">
    <h2 class="mb-4">✏️ Edit Contact Query</h2>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label"><b>Student Name</b></label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['student_name']); ?>"
                readonly>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>Subject</b></label>
            <input type="text" name="subject" class="form-control"
                value="<?php echo htmlspecialchars($data['subject']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>Message</b></label>
            <textarea name="message" class="form-control" rows="5"
                required><?php echo htmlspecialchars($data['message']); ?></textarea>
        </div>

        <div class="text-end">
            <a href="admin_contact.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">💾 Save Changes</button>
        </div>
    </form>
</div>
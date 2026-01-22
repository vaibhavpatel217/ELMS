<?php
include_once("includes/config.php");
session_start();
// (optional) admin login check here

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM subscribers WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Subscriber deleted successfully'); window.location='view-subscribers.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: view-subscribers.php");
}
?>
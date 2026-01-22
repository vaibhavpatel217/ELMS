<?php
session_start();
include_once("includes/config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM contact_queries WHERE id=$id");
}

header("Location: admin_contact.php");
exit();
?>
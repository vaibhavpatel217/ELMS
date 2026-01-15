<?php
// includes/contact_data.php
$contacts = [];

$conn = mysqli_connect("localhost", "root", "", "elearning1");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT type, value FROM contact_info";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $contacts[$row['type']] = $row['value'];
    }
}
?>

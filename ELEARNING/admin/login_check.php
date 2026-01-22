<?php
session_start();
include_once('includes/config.php');
extract(array: $_POST);
$qry = "select * from users where username='" . $username . "' && password='" .  $password. "'";
$result = mysqli_query(mysql: $conn, query: $qry) or exit("Select user fail" . mysqli_error(mysql: $conn));
$count = mysqli_num_rows(result: $result);

if ($count > 0) {
    $_SESSION['uname'] = $username;
    header(header: "location:dashboard.php");
} else {
    $_SESSION["error"] = "Username or Password is incorrect";
    header(header: "location:index.php");
}
?>
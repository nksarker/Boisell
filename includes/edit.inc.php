<?php
session_start();

require "db.php";

if (isset($_POST['editProfile'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $username = $_SESSION['username'];

    $update_sql = "update users set name = '$name', department = '$department', phone = '$phone' where username = '$username'";
    $update = mysqli_query($con, $update_sql);
    if ($update) {
        header('location: ../profile.php?edit=successful');
        exit();
    } else {
        header('location: ../profile.php?edit=unsuccessful');
        exit();
    }
}

<?php
session_start();
require_once 'db.php';
if (isset($_GET['id'])) {
    $sql = "select * from donate where id = " . $_GET['id'] . ";";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    $username = $row['username'];
}
if (isset($_POST['proceed'])) {
    if (isset($_SESSION['username'])) {
        $post_id = $_GET['id'];
        $buyer = $_SESSION['username'];
        $description = $_POST['description'];
        $sql = "insert into applications(post_id, buyer, description) values('$post_id', '$buyer', '$description')";

        if ($res = mysqli_query($con, $sql)) {
            header('location: ../donate-order.php?order=successful');
            exit();
        }
        // setcookie('id', $post_id, time() + 600);

    } else {
        header('location: ../ads.php?error=notloggedin');
    }
}

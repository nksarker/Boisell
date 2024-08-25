<?php
require "db.php";
session_start();

$username = $_SESSION['username'];
$subject = $_POST['subject'];
$post = $_POST['post'];
$file_name = $_FILES['image']['name'];

$sql = "insert into donate(username, subject, post, image) values('$username', '$subject', '$post', '$file_name')";

if (isset($_FILES['image'])) {
    $errors = array();
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $break = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($break));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        header('location: ../donate.php?post=extnotallowed');
        exit();

        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    } else if ($file_size > 4194304) {
        header('location: ../donate.php?post=maxsize');
        exit();

        $errors[] = 'File size must be excately 4 MB';
    } else if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "donate/" . $file_name);
        if (mysqli_query($con, $sql)) {
            header('location: ../donate.php?post=posted');
            exit();
        } else {
            header('location: ../donate.php?post=failed');
        }
    }
}
// header("location: ../donate.php?message=sent");

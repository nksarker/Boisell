<?php
session_start();
require_once "includes/db.php";
$sql1 = "select * from users where username = '" . $_SESSION['username'] . "'";
$res1 = mysqli_query($con, $sql1);
$row = mysqli_fetch_assoc($res1);

$sql2 = "select * from users where username = '" . $_GET['toUser'] . "'";
$res2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($res2);

// $fromUser = $_SESSION['username'];
// $toUser = $_GET['toUser'];
$message = $_POST['message'];
date_default_timezone_set("Asia/Dhaka");
$time = date("h:i a");
// $date = date("YY MM");

$output = "";
$message = str_replace("'", "\'", $message);
$sql = "insert into messages (fromUser, toUser, message, time) values (" . $row['id'] . ", " . $row2['id'] . ", '$message', '$time')";

if (!ctype_space($message) && !empty($message)) {
    $res = mysqli_query($con, $sql);
}
if ($res) {
    $output = "";
} else {
    $output = "Error, please try again!";
}
echo $output;

if (isset($_POST['send'])) {
}

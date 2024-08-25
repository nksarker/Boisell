<?php
require_once "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


$sql = "insert into contact(name, email, message) values('$name', '$email', '$message')";
$res = mysqli_query($con, $sql);

header("location: ../contact.php?message=sent");


// if (isset($_GET['submit'])) {
// }

<?php
session_start();
require_once 'db.php';
if (isset($_GET['id'])) {
    $sql = "select * from posts where id = " . $_GET['id'] . ";";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $subject = $row['subject'];
    $image = $row['image'];
    $username = $row['username'];
    $amount = $row['price'];
}
if (isset($_POST['proceed'])) {
    if (isset($_SESSION['username'])) {
        $payment = $_POST['payment'];
        $post_id = $_GET['id'];
        $buyer = $_SESSION['username'];
        $account = $_POST['account'];
        if ($payment == 'bkash') {
            $sql = "insert into orders(post_id, buyer, amount, payment, account) values('$post_id', '$buyer', '$amount', '$payment', '$account')";
        }
        if ($payment == 'card') {
            $name = $_POST['name'];
            $validity = $_POST['validity'];
            $cvv = $_POST['cvv'];
            $sql = "insert into orders(post_id, buyer, amount, payment, name, account, validity, cvv) values('$post_id', '$buyer', '$amount', '$payment', '$name', '$account', '$validity', '$cvv')";
        }
        if ($payment == 'bank') {
            $name = $_POST['name'];
            $bank = $_POST['bank'];
            $sql = "insert into orders(post_id, buyer, amount, payment, name, account, bank) values('$post_id', '$buyer', '$amount', '$payment', '$name', '$account', '$bank')";
        }

        if ($res = mysqli_query($con, $sql)) {
            header('location: ../order.php?order=successful');
        }

        // setcookie('id', $post_id, time() + 600);

        exit();
    } else {
        header('location: ../ads.php?error=notloggedin');
    }
}

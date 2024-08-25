<?php
session_start();
$_SESSION = array();
session_destroy();

if (isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    // $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];

    setcookie('username', $username, time() - 1);
    // setcookie('email', $email, time() - 1);
    setcookie('password', $password, time() - 1);
}

header('location: index.php?log=out');

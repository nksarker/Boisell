<?php

if (isset($_POST["submit"])) {
    $con = mysqli_connect('localhost', 'root', '', 'project_22');
    mysqli_select_db($con, 'project_22');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = mysqli_query($con, "select * from users where username = '$username';");

    if ($row = mysqli_fetch_array($user)) {
        if ($password == $row['password']) {
            if ($row['verified'] == 1) {
                if (isset($_POST['remember'])) {
                    setcookie('username', $username, time() + 600);
                    // setcookie('email', $email, time() + 60);
                    setcookie('password', $password, time() + 600);
                }
                session_start();

                $_SESSION['username'] = $username;
                header('location: ../index.php?login=successful');
                exit();
            } else {
                header('location: ../index.php?error=notverified');
                exit();
            }
        } else {
            // header('location: ../index.php?#modalLoginForm');
            header('location: ../index.php?error=invalidpassword');
        }
    } else {
        // header('location: ../login.php?error=invalidusername');
        header('location: ../index.php?error=invalidusername');
    }
}

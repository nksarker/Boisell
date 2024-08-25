<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
require "db.php";

if (isset($_POST['send'])) {
    $email = $_POST['email'];
    $sql = "select * from users where email = '$email'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    if (mysqli_num_rows($res) > 0) {
        $vkey = $row['vkey'];
        $verified = $row['verified'];

        if ($res) {
            if ($verified == 1) {
                $message = "Click the link to reset your boisell account's password- http://localhost/project_22/newPassword.php?vkey=$vkey";
                if (mail($email, "Reset password", $message)) {
                    echo "Mail sent to $email <br> Please check your email and set new password for your boisell account.";
                } else {
                    header('location: ../resetPassword.php?email=notsent');
                    exit();
                }
            } else {
                header('location: ../index.php?email=notreset');
                exit();
            }
        }
    } else {
        header('location: ../resetPassword.php?email=notmatch');
        exit();
    }
}




if (isset($_POST['change-pass'])) {
    $vkey = $_GET['vkey'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password == $confirmPassword) {
        $update_sql = "update users set password = '$password' where vkey = '$vkey' and verified = 1 limit 1";
        $update = mysqli_query($con, $update_sql);
        if ($update) {
            header('location: ../index.php?password=updated');
            exit();
        }
    } else {
        header('location: ../newPassword.php?password=notmatch');
        exit();
    }
}

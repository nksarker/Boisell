<?php
require "includes/db.php";

if (isset($_GET['vkey'])) {

    $vkey = $_GET['vkey'];

    $sql = "select vkey, verified from users where verified = 0 and vkey = '$vkey' limit 1";
    $res = mysqli_query($con, $sql);

    if ($res) {
        $vkey = $_GET['vkey'];

        $update_sql = "UPDATE users SET verified = 1 where vkey = '$vkey' limit 1;";
        $update = mysqli_query($con, $update_sql);

        if ($update) {
            header('location: index.php?account=verified');
            exit();
        }
    } else {
        echo "Invalid account";
    }
}

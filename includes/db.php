<?php

$con = mysqli_connect('localhost', 'root', '', 'project_22');
// mysqli_select_db($con, 'project_22');

if (!$con) {
    die("Failed to connect : " . mysqli_connect_error());
}

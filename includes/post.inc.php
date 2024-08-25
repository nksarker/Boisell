

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'project_22');
// mysqli_select_db($con, 'project_22');


$posts = mysqli_real_escape_string($con, $_POST['post']);
// date_default_timezone_set('America/Chicago');
$date = date("d m, Y == H:i:s");
$file_name = $_FILES['image']['name'];
$subject = $_POST['subject'];
$price = $_POST['price'];
$username = $_SESSION['username'];

$sql1 = "select * from users where username = '" . $_SESSION['username'] . "'";
$res1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($res1);
$department = $row1['department'];
$sql = "insert into posts(username, subject, price, post, image, department) values('{$username}', '{$subject}', '{$price}', '{$posts}', '{$file_name}', '{$department}');";

if (isset($_FILES['image'])) {
    $errors = array();
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $break = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($break));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        header('location: ../index.php?post=extnotallowed');
        exit();

        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    } else if ($file_size > 4194304) {
        header('location: ../index.php?post=maxsize');
        exit();

        $errors[] = 'File size must be excately 4 MB';
    } else if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        // echo "Success";
        if (mysqli_query($con, $sql)) {
            header('location: ../index.php?post=posted');
            exit();
        } else {
            header('location: ../index.php?post=failed');
        }
    }
    //else {
    //     print_r($errors);
    // }
}


?>


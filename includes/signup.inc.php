<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<?php
// session_start();

$name = $_POST['name'];
$department = $_POST['department'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$file_name = $_FILES['image']['name'];


$con = mysqli_connect('localhost', 'root', '', 'project_22');
mysqli_select_db($con, 'project_22');



if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    // die('Please fill all the required fields!');
    // header('location: ../signup.php?error=emptyinput');
    header('location: ../index.php?error=emptyinput');
    exit();
} else if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {

    if ($password !== $confirm_password) {
        // die('Password and confirm password do not match!');
        // header('location: ../signup.php?error=passnotmatch');
        header('location: ../index.php?error=passnotmatch');
        exit();
    } else {
        $sel_name = "select * from users where username = '$username'";
        $sel_mail = "select * from users where email = '$email'";
        $res_name = mysqli_query($con, $sel_name);
        $res_mail = mysqli_query($con, $sel_mail);
        $num_name = mysqli_num_rows($res_name);
        $num_mail = mysqli_num_rows($res_mail);

        if ($num_name == 1) {

            // header('location: ../signup.php?error=usernametaken');
            header('location: ../index.php?error=usernametaken');
            exit();
        } else if ($num_mail == 1) {


            header('location: ../index.php?error=emailtaken');
            exit();
        } else {
            if (isset($_FILES['image'])) {
                $errors = array();
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $exp = explode('.', $_FILES['image']['name']);
                $file_ext = strtolower(end($exp));

                $extensions = array("jpeg", "jpg", "png");


                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > 2097152) {
                    $errors[] = 'File size must be excately 2 MB';
                }

                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "user_image/" . $file_name);
                    // echo "Success";
                } else {
                    print_r($errors);
                }
            }
            $vkey = md5(time() . $username);

            $reg = "insert into users(name, department, username, image, email, phone, password, vkey) values('$name', '$department', '$username', '$file_name', '$email', '$phone', '$password', '$vkey')";
            $res = mysqli_query($con, $reg);

            if ($res) {
                $to = $email;
                $subject = "Email verification";
                $message = "Click the link to confirm: http://localhost/project_22/verify.php?vkey=$vkey";
                $headers = "From: nksarker1998@gmail.com";

                if (mail($to, $subject, $message, $headers)) {
                    echo "Email successfully sent to $to...";
                } else {
                    header('location: ../index.php?email=failed');
                    exit();
                }
            }
            // header('location: ../index.php?error=none');
            // exit();
        }
    }
} else {
    header('location: ../index.php?error=invalidemail');
    exit();
}

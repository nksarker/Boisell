<?php
include_once 'head.php';
require 'includes/db.php';
?>
<style>
    .categories {
        background-color: greenyellow;

    }


    .categories-li a {
        margin-left: 1rem;
        color: #264653;
        text-decoration: none;
    }

    .categories-li span {
        margin-right: 1rem;
        background-color: #264653;
    }
</style>

<div class="carousel silde" id="myCarousel" data-ride="carousel">
    <ol class="carousel-indicators">
        <li class="active" data-target="#myCarousel" data-slide-to="0" style="z-index: 102;">

        </li>
        <li data-target="#myCarousel" data-slide-to="1" style="z-index: 102;">

        </li>
        <li data-target="#myCarousel" data-slide-to="2" style="z-index: 102;">

        </li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/1book.jpg" class="imgFilter first-slide" alt="">
            <div class="carousel-caption">
                <h2>Buy, Sell or Donate your book!</h2>

            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/2book.jpg" class="imgFilter second-slide" alt="">
            <div class="carousel-caption">
                <h2>Buy, Sell or Donate your book!</h2>

            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/3book.jpg" class="imgFilter third-slide" alt="">
            <div class="carousel-caption">
                <h2>Buy, Sell or Donate your book!</h2>

            </div>
        </div>
    </div>
    <a href="#myCarousel" style="z-index: 101;" class="carousel-control-prev" role="button" data-slide="prev">
        <span aria-hidden="true" class="carousel-control-prev-icon"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a href="#myCarousel" style="z-index: 101;" class="carousel-control-next" role="button" data-slide="next">
        <span aria-hidden="true" class="carousel-control-next-icon"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="total-amount">
    <ul class="list-inline text-center">
        <li class="list-inline-item btn btn-sm btn-md"><span style="padding: 0 2rem;">Total users:
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'project_22');

                $sql = "select count(id) from users";

                $result = mysqli_query($con, $sql);
                $total_users = $result->fetch_array()[0] ?? '';
                echo $total_users;

                ?></span>
        </li>
        <li class="list-inline-item btn btn-sm btn-md"><span style="padding: 0 2rem;">Total ads:
                <?php
                // $con = mysqli_connect('localhost', 'root', '', 'project_22');

                $sql = "select count(id) from posts";

                $result = mysqli_query($con, $sql);
                $total_users = $result->fetch_array()[0] ?? '';
                echo $total_users;

                ?></span>
        </li>
    </ul>
</div>
<!-- <div class="text-center" style="margin: 2rem 0;">
    <h3>
        Buy, Sell or Donate your book!
    </h3>

</div> -->
<div class="d-flex justify-content-center">
    <a href="#latest-ad">
        <img src="assets/arrow-down.svg" style="height: 1.5rem; width: auto; margin-bottom: 2rem;" alt="">
    </a>
</div>



<!-- Latest post  -->

<div class="header d-flex justify-content-center" id="latest-ad" style="margin-bottom: 1rem;">
    <h4>Latest Ad</h4>
</div>
<div class="d-flex justify-content-center">
    <?php

    require_once 'includes/db.php';
    $sql = "select * from posts order by id desc;";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);



    if (mysqli_num_rows($res) > 0) {
        // while ($row = mysqli_fetch_assoc($res)) {
        $username = $row['username'];
        $post = $row['post'];
        $price = $row['price'];
        $subject = $row['subject'];
        $date_added = $row['date_added'];
        $date = date_format(new DateTime($date_added), "d M");
        $id = $row['id'];



        $sql_user = "select * from users where username = '$username'";
        $res_user = mysqli_query($con, $sql_user);
        $row_user = mysqli_fetch_assoc($res_user);

        $name = $row_user['name'];
        $department = strtoupper($row_user['department']);
        $image_user = $row_user['image'];
        $email = $row_user['email'];
        $phone = $row_user['phone'];

        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
        }


    ?>

        <div class="card card-li">

            <div class="post-head">
                <ul class="inline-list-head">
                    <li>
                        <a href="profile-others.php?user=<?php echo $username ?>" class="">
                            <?php
                            echo "<img class='post-user-image' src='includes/user_image/" . $image_user . "' >";
                            ?>
                        </a>
                    </li>
                    <li class="post-user">
                        <div class="row post-user-name">
                            <a href="profile-others.php?user=<?php echo $username ?>" class="post-user-name">
                                <?php
                                echo "$name";
                                ?>
                            </a>
                        </div>
                        <div class="row post-user-dept">
                            <?php
                            echo "$department .";
                            echo " $date";
                            ?>
                        </div>

                    </li>
                    <li>
                        <!-- <span class="btn btn-sm"> -->
                        <?php
                        echo "<span class='btn btn-sm price'>Tk $price</span>";
                        ?>
                        <!-- </span> -->
                    </li>
                </ul>
            </div>
            <div class="post-subject">
                <?php echo $subject ?>
            </div>

            <p class="post-main"><?php echo $post ?></p>

            <div class="post-image-container">
                <?php
                echo "<img class='post-image' src='includes/images/" . $row['image'] . "' >";
                ?>
            </div>
            <div class="post-footer">
                <ul class="inline-list">
                    <li>
                        <a style="padding-left: 1rem; padding-right: 1rem;" href="chatbox.php?toUser=<?php echo $username ?>" class="btn btn-sm btn-md">Message</a>
                    </li>
                    <li>
                        <a style="padding-left: 1rem; padding-right: 1rem;" href="mailto:<?php echo $email ?>?Subject=Boisell-buyer&Body=Is this available?" class="btn btn-sm btn-md">Email</a>
                    </li>
                    <li>
                        <a href="tel:+880<?php echo $phone ?>" class="btn btn-sm btn-md" style="padding-left: 1rem; padding-right: 1rem;">Call</a>
                    </li>
                    <li>
                        <a href="order.php?id=<?php echo $id ?>" style="padding-left: 1rem; padding-right: 1rem;" class="btn btn-sm btn-md">Buy</a>
                    </li>
                </ul>
            </div>

        </div>
    <?php
    }

    ?>
</div>

<!-- Categories  -->
<?php
if (isset($_SESSION['username'])) {
    echo
    '<div style="background-color: rgba(229, 229, 250,0.8); margin: 2rem 0; padding: 2rem;">
    <h5 class="d-flex justify-content-center">
        Want to donate a book?
    </h5>
    <div class="d-flex justify-content-center" style="margin-top: 2rem;">
        <a class="btn btn-sm" href="donate.php">Donate</a>
    </div>

</div>';
}
?>



<div class="header d-flex justify-content-center" id="post-by-department" style="margin: 5rem 0 2rem 0;">
    <h4>
        Posts by Departments
    </h4>
</div>
<ul class="categories list-group" style="width: 50%; margin: 0 auto;">
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=eee">
            <?php
            $sql = "select count(id) from posts where department = 'eee'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            EEE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=cse">
            <?php
            $sql = "select count(id) from posts where department = 'cse'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            CSE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=ece">
            <?php
            $sql = "select count(id) from posts where department = 'ece'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            ECE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=ete">
            <?php
            $sql = "select count(id) from posts where department = 'ete'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            ETE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=ce">
            <?php
            $sql = "select count(id) from posts where department = 'ce'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            CE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=arch">
            <?php
            $sql = "select count(id) from posts where department = 'arch'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            ARCH
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=becm">
            <?php
            $sql = "select count(id) from posts where department = 'becm'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            BECM
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=urp">
            <?php
            $sql = "select count(id) from posts where department = 'urp'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            URP
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=me">
            <?php
            $sql = "select count(id) from posts where department = 'me'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            ME
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=ipe">
            <?php
            $sql = "select count(id) from posts where department = 'ipe'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            IPE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=mte">
            <?php
            $sql = "select count(id) from posts where department = 'mte'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            MTE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=gce">
            <?php
            $sql = "select count(id) from posts where department = 'gce'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            GCE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=mse">
            <?php
            $sql = "select count(id) from posts where department = 'mse'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            MSE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>
    <li class="categories-li list-group-item d-flex justify-content-between align-items-center">
        <a href="dept-ads.php?department=cfpe">
            <?php
            $sql = "select count(id) from posts where department = 'cfpe'";
            $res = mysqli_query($con, $sql);
            $total = $res->fetch_array()[0] ?? '';
            ?>
            CFPE
        </a>
        <span class="badge badge-primary badge-pill">
            <?php echo $total ?>
        </span>
    </li>

</ul>




<!-- Messages  -->

<?php
if (isset($_GET['login'])) {
    if ($_GET['login'] == 'successful') {
        echo "<script>
        swal('Successful!', 'You have logged in', 'success');
        </script>";
    }
}
if (isset($_GET['account'])) {
    if ($_GET['account'] == 'verified') {
        echo "<script>
        swal('Verified!', 'You can now log in to your account', 'success');
        </script>";
    }
}
if (isset($_GET['password'])) {
    if ($_GET['password'] == 'updated') {
        echo "<script>
        swal('Done', 'Password updated successfully', 'success');
        </script>";
    }
}
if (isset($_GET['email'])) {
    if ($_GET['email'] == 'notreset') {
        echo "<script>
        swal('Can't reset password!', 'This account is not verified', 'error');
        </script>";
    } else if ($_GET['email'] == 'failed') {
        echo "<script>
        swal('Failed!', 'Couldn't send mail, 'error');
        </script>";
    }
}
if (isset($_GET['log'])) {
    if ($_GET['log'] == 'out') {
        echo "<script>
        swal('Logged out', 'You have logged out', 'success');
        </script>";
    }
}
if (isset($_GET['post'])) {
    if ($_GET['post'] == 'posted') {
        echo "<script>
        swal('Posted!', '', 'success');
        </script>";
    } else if ($_GET['post'] == 'extnotallowed') {
        echo "
        <script>
        swal('Unsupported file!', 'Try with JPG or PNG files', 'error');
        </script>";
    } else if ($_GET['post'] == 'maxsize') {
        echo "
        <script>
        swal('Too large!', 'File size should be maximum 4MB', 'error');
        </script>";
    } else if ($_GET['post'] == 'failed') {
        echo "
        <script>
        swal('Error!', 'Failed to post the ad', 'error');
        </script>";
    }
}
?>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyinput') {
        echo "<script>
        swal('Error!', 'Fill in all the fields', 'error');
        </script>";
    } else if ($_GET['error'] == 'passnotmatch') {
        echo "<script>
        swal('Passwords don't match!', 'Password and confirm password must be same', 'error');
        </script>";
    } else if ($_GET['error'] == 'usernametaken') {
        echo "<script>
        swal('Failed!', 'Username already taken', 'error');
        </script>";
    } else if ($_GET['error'] == 'emailtaken') {
        echo "<script>
        swal('Failed!', 'Email address already taken', 'error');
        </script>";
    } else if ($_GET['error'] == 'none') {
        echo "<script>
        swal('Success', 'Registration successful', 'success');
        </script>";
    } else if ($_GET['error'] == 'invalidemail') {
        echo "<script>
        swal('Failed!', 'Invalid email address', 'error');
        </script>";
    } else if ($_GET['error'] == 'notloggedin') {
        echo "<script>
        swal('Failed', 'You need to login first', 'error');
        </script>";
    }
}
?>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'wronglogin') {
        echo "<script>
        swal('Error!', 'Wrong username', 'error');
        </script>";
    } else if ($_GET['error'] == 'wrongpassword') {
        echo "<script>
        swal('Error!', 'Wrong password', 'error');
        </script>";
    } else if ($_GET['error'] == 'stmtfailed') {
        echo "<script>
        swal('Error!', 'Login failed', 'error');
        </script>";
    } else if ($_GET['error'] == 'invalidpassword') {
        echo "<script>
        swal('Error!', 'Password is invalid', 'error');
        </script>";
    } else if ($_GET['error'] == 'invalidusername') {
        echo "<script>
        swal('Error!', 'Username is invalid', 'error');
        </script>";
    } else if ($_GET['error'] == 'notverified') {
        echo "<script>
        swal('Error!', 'Your account is not verified', 'error');
        </script>";
    }
}
?>




<!-- </body> -->

<!-- </html> -->

<?php
include_once 'footer.php';
?>
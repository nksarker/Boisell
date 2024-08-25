<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="reset.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>বইসেল</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script>
        function popUp() {
            swal('Good job!', 'You clicked the button!', 'success');
        }
    </script> -->
</head>

<body>
    <header>
        <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
            <a href="index.php" class="navbar-brand">
                বইসেল
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="navbar-nav mr-auto menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="ads.php" class="nav-link">All ads</a>
                    </li>
                    <li class='nav-item' id='nav-link'>
                        <a class='nav-link' href='donate-ads.php'>Donation</a>
                    </li>

                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<li class='nav-item' id='nav-link'><a class='nav-link' href='my-ads.php'>My Ads</a></li>";
                        echo "<li class='nav-item' id='nav-link'><a class='nav-link' href='message.php'>Chat</a></li>";
                        echo "<li class='nav-item' id='nav-link'><a class='nav-link' href='profile.php?user=" . $_SESSION['username'] . "'>Profile</a></li>";
                        // echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Log out</a></li>";
                        echo "<li class='nav-item' id='nav-link'><a class='nav-link' data-toggle='modal' data-target='#modalPostForm' href=''>Post ad</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' data-toggle='modal' data-target='#modalRegisterForm' href='#'>Sign up</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' data-toggle='modal' data-target='#modalLoginForm' href='#'>Log in</a></li>";
                    }
                    ?>

                </ul>
                <script>
                    $('li').click(function() {
                        $(this).addClass('active');
                        $(this).siblings().removeClass('active');
                    });
                </script>

            </div>
        </nav>

    </header>

    <!-- Registration Form  -->

    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/signup.inc.php" method="post" enctype="multipart/form-data">

                    <div class="modal-body mx-3">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your full name" class="form-control validate" id="" required>

                        </div>
                        <div class="form-group d-flex">
                            <input style="margin-right: 1rem;" type="text" name="username" id="" class="form-control validate" placeholder="Username" required>
                            <select name="department" id="" class="form-control validate">
                                <option value="eee">EEE</option>
                                <option value="cse">CSE</option>
                                <option value="ece">ECE</option>
                                <option value="ete">ETE</option>
                                <option value="ce">CE</option>
                                <option value="arch">ARCH</option>
                                <option value="becm">BECM</option>
                                <option value="urp">URP</option>
                                <option value="me">ME</option>
                                <option value="ipe">IPE</option>
                                <option value="mte">MTE</option>
                                <option value="gce">GCE</option>
                                <option value="mse">MSE</option>
                                <option value="cfpe">CFPE</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" id="" placeholder="Profile picture" class="form-control validate" required>

                        </div>

                        <div class="form-group d-flex">
                            <input style="margin-right: 1rem;" type="email" name="email" id="" class="form-control validate" placeholder="Email address" required>
                            <input type="tel" pattern="[0-9]{2}[0-9]{3}[0-9]{6}" name="phone" id="" class="form-control validate" placeholder="Phone number">
                        </div>
                        <div class="form-group d-flex">
                            <input style="margin-right: 1rem;" type="password" name="password" id="" class="form-control validate" placeholder="Password" required>
                            <input type="password" name="confirm_password" id="" class="form-control validate" placeholder="Repeat password" required>
                        </div>
                    </div>
                    <!-- <div class='alert alert-danger text-center'>
                        <?php //echo "Username already taken!" 
                        ?>
                    </div> -->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-dark">Sign up</button>
                    </div>
                </form>
                <div class="text-center" style="margin: 2rem 0;">
                    <p>Already have an account? <a data-dismiss="modal" data-toggle="modal" data-target="#modalLoginForm" href="#">Login now</a></p>
                </div>
            </div>
        </div>
    </div>


    <!-- Login Form  -->

    <div class="modal fade login-modal" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/login.inc.php" method="post">

                    <div class="modal-body mx-3">
                        <!-- <form action="includes/login.inc.php" method="post"> -->
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control validate" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control validate" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <span><input type="checkbox" name="remember" value="1" id=""> Remember me</span>
                        </div>
                        <!-- </form> -->
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-dark">Login</button>
                    </div>
                </form>

                <div class="text-center" style="margin: 2rem 0;">
                    <p style="margin-bottom: 1rem;">Don't have an account? <a data-dismiss="modal" data-toggle="modal" data-target="#modalRegisterForm" href="#">Create one</a></p>
                    <p>Forgot password? <a href="resetPassword.php">Reset password</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
        $username = $_COOKIE['username'];
        // $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];

        echo "<script>
        document.getElementById('username') = $username;
        document.getElementById('password') = $password;
        
        </script>";
    }
    ?>


    <!-- post form  -->

    <div class="modal fade" id="modalPostForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Post a new ad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">

                    <form action="includes/post.inc.php" method="post" id="post-form" enctype="multipart/form-data">
                        <input type="hidden" name="size" value="1000000">
                        <div class="form-group d-flex">
                            <input style="margin-right: 1rem;" type="text" name="subject" class="form-control validate" placeholder="Subject" id="" required>
                            <input type="number" name="price" class="form-control validate" placeholder="Price" id="" required>
                        </div>
                        <div class="form-group">
                            <textarea name="post" id="post-body" class="form-control validate" cols="30" rows="5" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control validate" name="image" id="" required>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" name="post_submit" class="btn btn-dark">Post</button>

                        </div>
                    </form>




                </div>
                <!-- <div class="modal-footer d-flex justify-content-center">

                </div> -->

            </div>
        </div>
    </div>
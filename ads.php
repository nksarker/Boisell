<?php
include 'head.php';
?>
<section class="container">
    <div class="row d-flex justify-content-center">
        <!-- <div class="col-md-2">

        </div> -->
        <div class="col-sm-8 post-container d-flex justify-content-center">
            <div class="card post-bg">
                <ul style="margin-top: 3rem;">
                    <?php

                    ?>

                    <li class="d-flex justify-content-center total-post"><span style="margin-right: 0.3rem;"> Total ads</span>
                        <?php
                        require_once 'includes/db.php';

                        $sql = "select count(id) from posts";

                        $result = mysqli_query($con, $sql);
                        $total_users = $result->fetch_array()[0] ?? '';
                        echo "<span class='badge badge-pill badge-dark'>$total_users</span>";

                        ?>
                    </li>
                    <?php

                    $results_per_page = 5;
                    $sql = "select * from posts order by id desc;";

                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($res);


                    $number_of_results = mysqli_num_rows($res);
                    $number_of_pages = ceil($number_of_results / $results_per_page);

                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $this_page_first_result = ((int)$page - 1) * $results_per_page;

                    $sql = "select * from posts order by id desc limit " . $this_page_first_result . "," . $results_per_page;

                    $res = mysqli_query($con, $sql);


                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
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


                    ?>

                            <li class="card card-li">

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
                                            <a style="padding-left: 1rem; padding-right: 1rem;" href="mailto:<?php echo $email ?>?Subject=Boisell-buyer&Body=Message" class="btn btn-sm btn-md">Email</a>
                                        </li>
                                        <li>
                                            <a href="tel:+880<?php echo $phone ?>" style="padding-left: 1rem; padding-right: 1rem;" class="btn btn-sm btn-md">Call</a>
                                        </li>
                                        <li>
                                            <a href="order.php?id=<?php echo $id ?>" style="padding-left: 1rem; padding-right: 1rem;" class="btn btn-sm btn-md">Buy</a>
                                        </li>


                                    </ul>
                                </div>

                            </li>
                    <?php
                        }
                    }
                    echo '<ul class="pagination d-flex justify-content-center" style="margin: 2rem 0;">';
                    if (isset($_GET['page'])) {
                        $break = explode('=', $_GET['page']);
                        $page = end($break);
                        if ($page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="ads.php?page=' . ((int)$page - 1) . '">Previous</a></li>';
                        }
                    }
                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        echo '<li class="page-item"><a class="page-link" href="ads.php?page=' . $page . '">' . $page . '</a></li> ';
                    }
                    if (isset($_GET['page'])) {

                        $break = explode('=', $_GET['page']);
                        $page = end($break);
                    }
                    if (isset($_GET['page'])) {
                        $break = explode('=', $_GET['page']);
                        $page = end($break);

                        if ((int)$page < $number_of_pages) {
                            echo '<li class="page-item"><a class="page-link" href="ads.php?page=' . ((int)$page + 1) . '">Next</a></li>';
                        }
                    } else if ($number_of_pages > 1) {
                        $page = 1;
                        echo '<li class="page-item"><a class="page-link" href="ads.php?page=' . ((int)$page + 1) . '">Next</a></li>';
                    }
                    echo '</ul>';

                    ?>

                </ul>
            </div>
        </div>
        <!-- <div class="col-md-2">
            alert('You need to login first!');

        </div> -->
    </div>


</section>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'notloggedin') {
        echo "<script type='text/javascript'>
        swal('Error!', 'You have not logged in', 'error');
        </script>";
    }
}

include 'footer.php';
?>
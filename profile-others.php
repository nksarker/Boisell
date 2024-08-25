<?php
include 'head.php';
?>

<?php
require_once 'includes/db.php';

if (isset($_GET['user'])) {

    $username = $_GET['user'];

    // $break = explode('=', $_GET['user']);
    // $username = end($break);
}

$sql = "select * from users where username = '$username'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$email = $row['email'];
$phone = $row['phone'];
$name = $row['name'];
$department = strtoupper($row['department']);
?>
<div class="profile-container">
    <div class="profile-bg fixed">

    </div>
    <div class="profile-img-container">
        <?php
        echo "<img class='card profile-img' src='includes/user_image/" . $row['image'] . "' >";

        ?>
    </div>

    <div class="profile-details">
        <?php
        echo "<div class='profile-text d-flex'><i class='fa fa-user'></i>  <label>$name</label></div>";
        echo "<div class='profile-text d-flex'><i class='fa fa-user'></i> <label>$username</label></div>";
        echo "<div class='profile-text d-flex'><i class='fa fa-envelope'></i>  <label>$email</label></div>";
        echo "<div class='profile-text d-flex'><i class='fa fa-phone'></i>  <label>0$phone</label></div>";
        echo "<div class='profile-text d-flex'><i class='fa fa-university'></i>  <label>$department</label></div>";

        ?>
    </div>
    <div class="d-flex justify-content-center">
        <a style="margin-top: 5rem;" href="chatbox.php?toUser=<?php echo $username ?>" class="btn">
            Message
        </a>
    </div>
</div>
<?php
include 'footer.php';
?>
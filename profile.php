<?php
include 'head.php';
?>
<style>
    @media screen and (max-width: 600.4px) {
        .editProfile .form-control {
            max-width: 60%;
        }
    }
</style>
<?php
require_once 'includes/db.php';


$username = $_SESSION['username'];
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
        <div class="d-flex justify-content-around" style="margin-top: 2rem; padding-top: 1rem; border-top: 2px solid #797979;">
            <a data-toggle='modal' data-target='#editProfileForm' href="#" style="color: #797979;"><i class="fa fa-edit" style="font-size: 1.5rem;"></i></a>
            <a href="resetPassword.php" style="color: #797979;"><i class="fa fa-key" style="font-size: 1.5rem;"></i></a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <a style="margin-top: 5rem;" href="logout.php" class="btn">
            Log out
        </a>
    </div>
</div>



<!-- Profile Edit Form 
************************************************ -->

<div class="modal fade" id="editProfileForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="includes/edit.inc.php" method="post" enctype="multipart/form-data">

                <div class="modal-body mx-3 editProfile">
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <label for="name">Name</label>
                        <input style="width: 20rem;" type="text" name="name" class="form-control validate" id="" placeholder="Your full name" value="<?php echo $name ?>" required>

                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <label for="department">Department</label>
                        <select style="width: 20rem;" name="department" id="" class="form-control validate" value="<?php echo $department ?>">
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

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <label for="phone">Phone no.</label>
                        <input style="width: 20rem;" type=" tel" pattern="[0-9]{2}[0-9]{3}[0-9]{6}" name="phone" id="" class="form-control validate" placeholder="Phone number" value="0<?php echo $phone ?>">

                    </div>

                </div>

                <div class=" modal-footer d-flex justify-content-center">
                    <button type="submit" name="editProfile" class="btn btn-dark">Done</button>
                </div>
            </form>

        </div>
    </div>
</div>


<?php
if (isset($_GET['edit'])) {
    if ($_GET['edit'] == 'successful') {
        echo "<script>
        swal('Done!', 'Successfully edited profile', 'success');
        </script>";
    } else if ($_GET['edit'] == 'unsuccessful') {
        echo "<script>
        swal('Failed!', 'Couldn't update information', 'error');
        </script>";
    }
}


include 'footer.php';
?>
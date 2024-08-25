<style>
    .form-style {
        border: 1px solid rgba(38, 70, 83, 0.5);
        border-radius: 5px;
        margin-right: 0.5rem;
        padding: 0.2rem;
        margin-bottom: 0.5rem;
        margin-top: 0.5rem;
    }
</style>
<?php
include 'head.php';
require_once 'includes/db.php';

if (isset($_GET['id'])) {
    $sql = "select * from donate where id = " . $_GET['id'] . ";";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $subject = $row['subject'];
    $image = $row['image'];
    $username = $row['username'];
?>

    <div style="margin-top: 5rem;">
        <h4 class="header d-flex justify-content-center">
            Apply for Donation
        </h4>
        <p style="color:green; margin: 3rem 0; text-align: center;">
            Apply here to get this book.
            We will check the applications and give it to one who needs it most.
        </p>
        <div class="row" style="margin: 1rem 0;">
            <div class="col-sm-6" style="margin-bottom: 2rem;">
                <img src="includes/donate/<?php echo $image ?>" style="width: 100%; height: 200px; border-radius: 5px 5px 0 0;">
                <p class="text-center" style="font-size: 0.9rem; padding: 0.5rem 0; background-color: khaki; border-radius: 0 0 5px 5px;">
                    Donated by <?php echo $username ?>

                </p>
            </div>
            <div class="col-sm-6">
                <h5 class="" style="font-weight: 600; font-size: 1.1rem;">
                    <?php echo $subject ?>
                </h5>

                <label for="" class="btn btn-sm" style="margin: 1rem 0; background: khaki; color: rgb(38, 70, 83);">
                    Price: *This is a donation.
                </label>
                <form action="includes/donate-order.inc.php?id=<?php echo $_GET['id'] ?>" method="post">
                    <div>
                        <label for="description">Why you need this?</label><br>
                        <textarea name="description" id="" cols="30" rows="5" class="form-style" placeholder="Describe" required></textarea>
                    </div>
                    <button type="submit" name="proceed" class="btn btn-sm">Proceed</button>

                </form>

            </div>


        </div>
    </div>
<?php
}
?>

<?php
// if (isset($_COOKIE['id']))
if (isset($_GET['order'])) {
    if ($_GET['order'] == 'successful') {

?>
        <div class="text-center" style="margin-top: 5rem;">
            <div class="alert text-center" style="background-color: lightgreen; padding: 1rem 0; border-radius: 5px;">
                Your application is successfully placed.
            </div>
            <p class="text-center" style="margin-top: 5rem;">
                <a class="btn btn-sm" href="ads.php">View all ads</a>
            </p>
        </div>


<?php
    }
}

include "footer.php";
?>
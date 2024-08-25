<?php
include "head.php";
?>
<div class="header d-flex justify-content-center" id="post-by-department" style="margin: 5rem 0 2rem 0;">
    <h4>
        New Password
    </h4>
</div>
<div class="d-flex justify-content-center container">
    <form action="includes/resetPassword.inc.php?vkey=<?php echo $_GET['vkey'] ?>" method="POST">
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Type new password" id="" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm new password" id="" required>
            <p style="margin-top: 0.5rem; color: green; font-size: 80%; line-height: 1.3;">
                Password and confirm password must be same.
            </p>
        </div>
        <div class="form-group d-flex justify-content-center">
            <input class="btn btn-sm" type="submit" name="change-pass" value="Confirm" id="">
        </div>
    </form>
</div>

<?php
if (isset($_GET['password'])) {
    if ($_GET['password'] == 'notmatch') {
        echo "<script>
        swal('Error!', 'Password not matching', 'error');
        </script>";
    }
}
if (isset($_GET['email'])) {
    if ($_GET['email'] == 'notsent') {
        echo "<script>
        swal('Error!', 'Couldn't send mail', 'error');
        </script>";
    }
}


include "footer.php";
?>
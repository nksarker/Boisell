<?php
include "head.php";
?>
<div class="header d-flex justify-content-center" id="post-by-department" style="margin: 5rem 0 2rem 0;">
    <h4>
        Reset Password
    </h4>
</div>
<div class="d-flex justify-content-center container">
    <form action="includes/resetPassword.inc.php" method="POST">
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Type your email" required>
            <p style="margin-top: 0.5rem; color: green; font-size: 80%; line-height: 1.3;">
                Enter the email that you used to create account on boisell.<br>
                We will send you a link to your email address for changing your password.
            </p>
        </div>

        <div class="form-group d-flex justify-content-center">
            <input class="btn btn-sm" type="submit" name="send" value="Send mail" id="">
        </div>
    </form>
</div>

<?php
if (isset($_GET['email'])) {
    if ($_GET['email'] == 'notmatch') {
        echo "<script>
            swal('Unknown email!', 'Please enter correct email address', 'error');
        </script>";
    } else if ($_GET['email'] == 'notsent') {
        echo "<script>
        swal('Failed!', 'Couldn't send mail', 'error');
        </script>";
    }
}

include "footer.php";
?>
<?php
include "head.php";
?>
<div style="margin-top: 5rem; width: 80%; margin-left: auto; margin-right: auto; line-height: 1.3; text-align: justify;" class="">
    <h4 class="header text-center" style="margin-bottom: 2rem;">
        Book Donation
    </h4>
    <p>List the book you want to donate, we will contact you.</p>
    <br>
    <p>
        Or contact us through <a href="contact.php">contact us</a> page.
    </p>
    <div style="margin-top: 2rem;">
        <form action="includes/donate.inc.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div class="form-group">
                <input type="text" name="subject" class="form-control" placeholder="Subject" id="" required>
            </div>
            <div class="form-group">
                <textarea name="post" id="" class="form-control validate" cols="30" rows="5" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
                <input type="file" class="form-control validate" name="image" id="" required>
            </div>
            <input type="submit" class="btn btn-sm" name="send" id="" value="List book">
        </form>
    </div>
</div>

<?php

if (isset($_GET['post'])) {
    if ($_GET['post'] == 'posted') {
        echo "<script>
        swal('Successful', 'Added to the listing', 'success');
        </script>";
    } else if ($_GET['post'] == 'extnotallowed') {
        echo "
        <script>
        swal('Error!', 'Extension not allowed', 'error');
        </script>";
    } else if ($_GET['post'] == 'maxsize') {
        echo "
        <script>
        swal('Error!', 'File size should be maximum 4 MB', 'error');
        </script>";
    } else if ($_GET['post'] == 'failed') {
        echo "
        <script>
        swal('Error!', 'Listing failed', 'error');
        </script>";
    }
}

include "footer.php";
?>
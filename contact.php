<?php
include('head.php');
?>

<div style="margin-top: 5rem; width: 80%; margin-left: auto; margin-right: auto; line-height: 1.3; text-align: justify;" class="">
    <h4 class="header text-center" style="margin-bottom: 2rem;">
        Contact Us
    </h4>
    <p>If you have any query regrading Site, Advertisement and any other issue, please feel free to contact at <strong>nksarker11@gmail.com</strong></p>
    <br>
    <p>
        Or send us a message filling up the correct information in the boxes bellow:
    </p>
    <div style="margin-top: 2rem;">
        <form action="includes/contact.inc.php" method="POST">
            <div class="form-group">
                <input type="text" name="name" id="" class="form-control" placeholder="Your full name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="" class="form-control" placeholder="Enter your email address" required>
            </div>
            <div class="form-group">
                <textarea name="message" id="" rows="5" class="form-control" placeholder="Type your message" required></textarea>
            </div>
            <input type="submit" class="btn btn-sm" name="send" id="" value="Send">
        </form>
    </div>
</div>


<?php
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'sent') {
        echo "<script>
            alert('Successfully sent!');
        </script>";
    }
}
include('footer.php');
?>
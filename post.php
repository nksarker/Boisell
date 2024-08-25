<?php
include 'head.php';
?>

<section style="margin-top:5rem;" class="post-form container">

    <form action="includes/post.inc.php" method="post" id="post-form" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div class="form-group">
            <textarea name="post" id="post-body" cols="30" rows="10" placeholder="Type here"></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="image" id="">
        </div>

        <button type="submit" name="post_submit" class="btn btn-primary">Post</button>
    </form>
</section>

<?php
include 'footer.php';
?>
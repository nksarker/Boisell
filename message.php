<style>
    .list-group li {
        margin: 0.4rem;
    }

    .list-group li a {
        width: 15rem;
        background-color: rgba(229, 229, 250, 0.5);
        color: #264653;
        padding: 1.2rem;
        border-radius: 10px;
        box-shadow: 5px 3px 10px #595959;
    }

    .list-group li a img {
        margin-right: 0.5rem;
        height: 2rem;
        width: 2rem;
        border-radius: 50%;
        border: 2px solid transparent;
        background:
            linear-gradient(to right, white, white),
            linear-gradient(-120deg, khaki, #fc00ff);
        background-clip: padding-box, border-box;
        background-origin: padding-box, border-box;

    }

    .list-group li a:hover {
        background-color: khaki;
        transition: all 0.4s;
    }
</style>

<?php
include "head.php";
require_once "includes/db.php";
?>
<div class="header d-flex justify-content-center" id="post-by-department" style="margin: 5rem 0 2rem 0;">
    <h4>
        All Conversations
    </h4>
</div>
<div class="d-flex justify-content-center" style="overflow-y: scroll; padding:1rem;">
    <ul class="list-group">
        <?php
        $sql = "select * from users where username = '" . $_SESSION['username'] . "'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);

        $fromUser = $row['id'];

        $sql1 = "select * from messages where fromUser = $fromUser or toUser = $fromUser";
        $res1 = mysqli_query($con, $sql1);

        $store = 0;

        $check = array();
        while ($row1 = mysqli_fetch_assoc($res1)) {
            if ($row1['fromUser'] == $fromUser) {
                $toUser = $row1['toUser'];
            } else {
                $toUser = $row1['fromUser'];
            }
            $sql2 = "select * from users where id = $toUser";
            $res2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($res2);
            $sender = $row2['username'];
            $sender_name = $row2['name'];
            $sender_image = $row2['image'];

            if ($row1['fromUser'] = $fromUser && $row1['toUser'] = $toUser || $row1['fromUser'] = $toUser && $row1['toUser'] = $fromUser) {
                if ($store != $toUser) {
                    $check[] = $toUser;
                    if (!array_key_exists($toUser, $check)) {
                        echo "<li><a class='nav-link' style='' href='chatbox.php?toUser=$sender'>
                        <img class='' src='includes/user_image/$sender_image'>
                        $sender_name
                        </a></li>";
                    }
                    $store = $toUser;
                } else {
                    continue;
                }
            }
        }
        ?>
    </ul>
</div>
<?php
include "footer.php";
?>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .toUser-img {
        height: 2rem;
        width: 2rem;
        border-radius: 50%;
        margin-right: 0.5rem;
        border: 2px solid transparent;
        background:
            linear-gradient(to right, white, white),
            linear-gradient(-120deg, khaki, #fc00ff);
        background-clip: padding-box, border-box;
        background-origin: padding-box, border-box;
    }

    .toUser-img2 {
        height: 1.5rem;
        width: 1.5rem;
        border-radius: 50%;
        border: 2px solid transparent;
        background:
            linear-gradient(to right, white, white),
            linear-gradient(-120deg, khaki, #fc00ff);
        background-clip: padding-box, border-box;
        background-origin: padding-box, border-box;
    }

    #msgBody {
        width: 100%;
        height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
        background-color: white;
        padding: 0.2rem 0;
        border-left: 1px solid khaki;
        border-right: 1px solid khaki;

    }

    #message {
        width: 70%;
        height: 2rem;
        font-size: 12px;
        border-radius: 20px;
    }

    #send {
        background-color: khaki;
        border: none;
        color: #264653;
    }
</style>


<?php
// session_start();
include "head.php";
require_once "includes/db.php";
if (isset($_SESSION['username'])) {
    if (isset($_GET['toUser'])) {

        $username = $_GET['toUser'];
    }

    $sql = "select * from users where username = '$username'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);



?>



    <div style="margin-top: 5rem;" class="container-fluid">
        <div class="row">
            <div class="col-1 col-sm-3 col-md-4">

            </div>
            <div class="col-10 col-sm-6 col-md-4">
                <h4 class="" style="border-radius: 5px 5px 0 0; background-color: khaki; padding: 0.5rem 0.3rem;">
                    <?php
                    if (isset($_GET['toUser'])) {
                        $uName = mysqli_fetch_assoc(mysqli_query($con, "select * from users where username ='$username'"));
                        echo "<input type='text' value='$username' id='toUser' hidden/>";
                        echo "<img class='toUser-img' src='includes/user_image/" . $uName['image'] . "' >";
                        echo "<span style='color: #264653; font-size: 1.2rem;'>" . $uName['name'] . "</span>";
                    } else {
                        $uName = mysqli_fetch_assoc(mysqli_query($con, "select * from users"));
                        $_SESSION['toUser'] = $uName['id'];
                        echo "<input type='text' value='" . $_SESSION['username'] . "' id='fromUser' hidden/>";
                        echo "<img class='toUser-img' src='includes/user_image/" . $uName['image'] . "' >";
                        echo "<span style='color: #264653; font-size: 1.2rem;'>" . $uName['name'] . "</span>";
                    }

                    ?>
                </h4>
                <div id="msgBody">
                    <?php
                    if (isset($_GET['toUser'])) {
                        $sql1 = "select * from users where username = '" . $_SESSION['username'] . "'";
                        $res1 = mysqli_query($con, $sql1);
                        $row1 = mysqli_fetch_assoc($res1);

                        $sql2 = "select * from users where username = '" . $_GET['toUser'] . "'";
                        $res2 = mysqli_query($con, $sql2);
                        $row2 = mysqli_fetch_assoc($res2);

                        $chats = mysqli_query($con, "select * from messages where (fromUser = " . $row2['id'] . " and toUser = " . $row1['id'] . ") or (fromUser = " . $row1['id'] . " and toUser = " . $row2['id'] . ")");
                    } else {
                        $chats = mysqli_query($con, "select * from messages where (fromUser = '" . $_SESSION["toUser"] . "' and toUser = " . $row1['id'] . ") or (fromUser = " . $row1['id'] . " and toUser = '" . $_SESSION["toUser"] . "')");
                    }

                    echo "<div class='d-flex justify-content-center'>
                    <img class='' src='includes/user_image/" . $row2['image'] . "' 
                    style='margin: 2rem 0 1rem 0;
                    height: 3rem;
                    width: 3rem;
                    border-radius: 50%;
                    border: 2px solid transparent;
                    background:
                        linear-gradient(to right, white, white),
                        linear-gradient(-120deg, khaki, #fc00ff);
                    background-clip: padding-box, border-box;
                    background-origin: padding-box, border-box;' >
                    </div>
                    <div class='d-flex justify-content-center' style='margin'><span>Chat with <span><span style='color: green;'>" . $row2['name'] . "</span></div>
                    ";

                    $date = date("Y-M-D");

                    while ($chat = mysqli_fetch_assoc($chats)) {
                        if ($date != $chat['date']) {
                            $date = $chat['date'];
                            $newDate = date_format(new DateTime($date), "d M");
                            echo "<p class='d-flex justify-content-center' style='margin: 2rem 0 1rem 0; color: rgba(38, 70, 83, 0.7); font-size: 70%;'>
                            $newDate
                            </p>";
                        }

                        if ($chat['fromUser'] == $row1['id']) {
                            echo "
                                <div class='d-flex justify-content-end align-items-center'>
                                <span class='d-inline-block' style='color: rgba(38, 70, 83, 0.5); font-size: 50%; margin: 0 0.3rem;'>" . $chat['time'] . "</span>

                                <p class='text-white' style='background-color: #264653; word-wrap: break-word; display: inline-block; padding: 0.4rem 0.6rem; border-radius: 15px; margin: 0.1rem 0.3rem 0.1rem 0'>
                                " . $chat['message'] . "
                                </p>
                                </div>
                                ";
                        } else {
                            echo "
                                <div class='d-flex align-items-center'>
                                <img class='toUser-img2' src='includes/user_image/" . $uName['image'] . "' style='margin-left: 0.3rem' >
                                <p style='background-color: #F0F2F5; word-wrap: break-word; display: inline-block; padding: 0.4rem 0.6rem; border-radius: 15px; margin: 0.1rem 0 0.1rem 0.3rem'>
                                " . $chat['message'] . "
                                </p>
                                <span class='' style='color: rgba(38, 70, 83, 0.5); font-size: 50%; margin: 0 0.3rem; font-size: 50%;'>" . $chat['time'] . "</span>


                                </div>
                                ";
                        }
                    }

                    ?>
                </div>
                <div class="row d-flex justify-content-around" style="margin: 0 0 0.3rem 0; padding: 0.3rem 0; border-radius: 0 0 5px 5px; background-color: khaki;">
                    <textarea name="message" class="form-control" id="message" placeholder="Type message"></textarea>
                    <button type="submit" class="" id="send">Send</button>
                </div>
            </div>
            <div class="col-xs-2 col-sm-3 col-md-4">

            </div>
        </div>
    </div>
<?php
} else {
    header('location: index.php?error=notloggedin');
    exit();
}
?>
<script>
    $(document).ready(function() {
        $("#send").click(function() {
            $.post("insert.php?toUser=<?php echo $username ?>", {
                    fromUser: $("#fromUser").val(),
                    toUser: $("#toUser").val(),
                    message: $("#message").val()
                },
                function(data, status) {
                    $("#message").val("");
                });
        });
        setInterval(function() {
            $.post("realTimeChat.php?toUser=<?php echo $username ?>", {
                    fromUser: $("#fromUser").val(),
                    toUser: $("#toUser").val()
                },
                function(data, status) {
                    $("#msgBody").html(data);
                });

        }, 700);

        $("#send").click(function() {
            $("#msgBody").animate({
                scrollTop: 1000000
            }, 800);
        });

        $("#msgBody").animate({
            scrollTop: 1000000
        }, 800);



    });
</script>

<?php
include "footer.php";
?>
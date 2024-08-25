<!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
<style>

</style>
<?php
session_start();
require_once "includes/db.php";

$sql1 = "select * from users where username = '" . $_SESSION['username'] . "'";
$res1 = mysqli_query($con, $sql1);
$row = mysqli_fetch_assoc($res1);

$sql2 = "select * from users where username = '" . $_GET['toUser'] . "'";
$res2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($res2);

$fromUser = $row['id'];
$toUser = $row2['id'];



$date = date("Y-M-D");
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

$chats = mysqli_query($con, "select * from messages where (fromUser = '" . $fromUser . "' and toUser = '" . $toUser . "') or (fromUser = '" . $toUser . "' and toUser = '" . $fromUser . "')");
while ($chat = mysqli_fetch_assoc($chats)) {
    if ($date != $chat['date']) {
        $date = $chat['date'];
        $newDate = date_format(new DateTime($date), "d M");
        echo "<p class='d-flex justify-content-center' style='margin: 2rem 0 1rem 0; color: rgba(38, 70, 83, 0.7); font-size: 70%;'>
        $newDate
        </p>";
    }



    if ($chat['fromUser'] == $fromUser) {
        $output = "
                <div class='d-flex justify-content-end align-items-center'>
                <span class='' style='color: rgba(38, 70, 83, 0.5); font-size: 50%; margin: 0 0.3rem;'>" . $chat['time'] . "</span>

                <p class='text-white' style='background-color: #264653; word-wrap: break-word; display: inline-block; padding: 0.4rem 0.6rem; border-radius: 15px; margin: 0.1rem 0.3rem 0.1rem 0'>
                " . $chat['message'] . "
                
                </p>
                
                </div>
                ";
    } else {
        $output = "
                <div class='d-flex align-items-center''>
                <img class='toUser-img2' src='includes/user_image/" . $row2['image'] . "' style='margin-left: 0.3rem' >
                <p class='' style='background-color: #F0F2F5; word-wrap: break-word; display: inline-block; padding: 0.4rem 0.6rem; border-radius: 15px; margin: 0.1rem 0 0.1rem 0.3rem'>
                " . $chat['message'] . "
                </p>
                <span class='' style='color: rgba(38, 70, 83, 0.5); font-size: 50%; margin: 0 0.3rem; font-size: 50%;'>" . $chat['time'] . "</span>


                </div>
                ";
    }
    echo $output;
}

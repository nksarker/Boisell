<style>
    .form-style {
        border: 1px solid rgba(38, 70, 83, 0.5);
        border-radius: 5px;
        margin-right: 0.5rem;
        padding: 0.2rem;
        margin-bottom: 0.5rem;
    }
</style>
<?php
include 'head.php';
require_once 'includes/db.php';

if (isset($_GET['id'])) {
    $sql = "select * from posts where id = " . $_GET['id'] . ";";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $subject = $row['subject'];
    $image = $row['image'];
    $username = $row['username'];
    $price = $row['price'];
?>

    <div style="margin-top: 5rem;">
        <h4 class="header d-flex justify-content-center">
            Order the Book
        </h4>
        <div class="row" style="margin: 3rem 0;">
            <div class="col-sm-6" style="margin-bottom: 2rem;">
                <img src="includes/images/<?php echo $image ?>" style="width: 100%; height: 200px; border-radius: 5px 5px 0 0;">
                <p class="text-center" style="font-size: 0.9rem; padding: 0.5rem 0; background-color: khaki; border-radius: 0 0 5px 5px;">
                    Posted by <?php echo $username ?>

                </p>
            </div>
            <div class="col-sm-6">
                <h5 class="" style="font-weight: 600; font-size: 1.1rem;">
                    <?php echo $subject ?>
                </h5>

                <label for="" class="btn btn-sm" style="margin: 1rem 0; background: khaki; color: rgb(38, 70, 83);">
                    Price: <?php echo $price ?> Taka
                </label>
                <form action="includes/order.inc.php?id=<?php echo $_GET['id'] ?>" method="post">
                    <div>
                        <label for="payment"> Payment method</label>
                        <select name="payment" id="method" class="form-style" onchange="return showMethod();">
                            <option value="bkash">Bkash</option>
                            <option value="card">Visa/Master Card</option>
                            <option value="bank">Bank Transfer</option>
                        </select>
                    </div>
                    <div style="margin-top: 1rem; display: block;" id="bkash-payment">
                        <h5 style="margin-bottom: 0.5rem;">
                            Bkash Payment
                        </h5>
                        <form action="includes/order.inc.php?id=<?php echo $_GET['id'] ?>" method="post">

                            <div>
                                <input class="form-style" name="account" pattern="[0-9]{2}[0-9]{3}[0-9]{6}" type="phone" placeholder="Your account no." required>
                            </div>
                            <!-- <input type="submit" value="Proceed" name="proceed" class="btn btn-sm"> -->
                            <button type="submit" name="proceed" class="btn btn-sm">Proceed</button>
                        </form>
                    </div>
                    <div style="margin-top: 1rem; display: none;" id="card-payment">
                        <h5 style="margin-bottom: 0.5rem;">
                            Card Payment
                        </h5>
                        <form action="includes/order.inc.php?id=<?php echo $_GET['id'] ?>" method="post">

                            <div class="">
                                <input name="name" class="form-style" type="text" placeholder="Name on card" required>
                            </div>
                            <div class="">
                                <input name="account" class="form-style" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}" type="number" placeholder="Card no." required>
                            </div>
                            <div class="">
                                <input name="validity" class="form-style" pattern="[0-9]{2}[0-9]{2}" type="number" placeholder="mm/yy" required>
                            </div>
                            <div class="">
                                <input name="cvv" class="form-style" pattern="[0-9]{3}" type="number" placeholder="cvv" required>
                            </div>
                            <button type="submit" name="proceed" class="btn btn-sm">Proceed</button>
                        </form>
                    </div>
                    <div style="margin-top: 1rem; display: none;" id="bank-transfer">
                        <h5 style="margin-bottom: 0.5rem;">
                            Bank Transfer
                        </h5>
                        <form action="includes/order.inc.php?id=<?php echo $_GET['id'] ?>" method="post">

                            <div class="" style="height: 2.4rem;">
                                <select name="bank" id="bank" class="form-style" onfocus="this.size=5" onblur="this.size=1" onchange="this.size=1; this.blur();">
                                    <option value="ab-bank">AB Bank</option>
                                    <option value="city-bank">City Bank</option>
                                    <option value="eastern-bank">Eastern Bank</option>
                                    <option value="sonali-bank">Sonali Bank</option>
                                    <option value="rupali-bank">Rupali Bank</option>
                                    <option value="janata-bank">Janata Bank</option>
                                    <option value="grameen-bank">Grameen Bank</option>
                                    <option value="asia-bank">Asia Bank</option>
                                    <option value="agricultural-bank">Agricultural Bank</option>
                                    <option value="one-bank">One Bank</option>
                                </select>
                            </div>

                            <div class="">
                                <input name="name" class="form-style" type="text" placeholder="Name of account holder" required>
                            </div>
                            <div class="">
                                <input name="account" class="form-style" type="number" placeholder="Account no." required>
                            </div>
                            <button type="submit" name="proceed" class="btn btn-sm">Proceed</button>

                        </form>
                    </div>

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
                Your order is successfully placed.
            </div>
            <p class="text-center" style="margin-top: 5rem;">
                <a class="btn btn-sm" href="ads.php">View all ads</a>
            </p>
        </div>


<?php
    }
}
?>

<script>
    function showMethod() {
        var selMethod = document.getElementById('method');
        var userInput = selMethod.options[selMethod.selectedIndex].value;

        if (userInput == 'bkash') {
            document.getElementById('bkash-payment').style.display = 'block';
        } else {
            document.getElementById('bkash-payment').style.display = 'none';
        }

        if (userInput == 'card') {
            document.getElementById('card-payment').style.display = 'block';
        } else {
            document.getElementById('card-payment').style.display = 'none';
        }

        if (userInput == 'bank') {
            document.getElementById('bank-transfer').style.display = 'block';
        } else {
            document.getElementById('bank-transfer').style.display = 'none';
        }

        return false;
    }
</script>

<?php
include "footer.php";
?>
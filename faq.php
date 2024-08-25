<style>
    .card {
        margin-bottom: 1rem;
    }
</style>
<?php
include('head.php');
?>

<div style="margin-top: 5rem; width: 80%; margin-left: auto; margin-right: auto; line-height: 1.3; text-align: justify;" class="">
    <h4 class="header text-center" style="margin-bottom: 2rem;">
        FAQs
    </h4>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <span>What is Boisell?</span>
                    <button style="float: right;" class="btn btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        See
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    Boisell is a web platform for the students to buy, sell or donate their books. This platform helps you to find your required book very easily. </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <span>How we work?</span>

                    <button style="float: right;" class="btn btn-sm collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        See
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    This platform can help you find your required books or find people to sell your books to.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <span>Is this secured?</span>
                    <button style="float: right;" class="btn btn-sm collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        See
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    We gather people's information while registering on this website and store them carefully. So you have nothing to worry about the security.
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
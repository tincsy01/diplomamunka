
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Coupon Check</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/icomoon.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/superfish.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../assets/js/modernizr-2.6.2.min.js"></script>
    <script src="../assets/js/respond.min.js"></script>
    <script src="../assets/js/scripts/check_coupon.js"></script>
</head>
<body>
<div id="fh5co-wrapper">
    <div id="fh5co-page">
        <div id="fh5co-header">
            <?php
            require_once '../assets/php/includes/header.php';
            ?>
        </div>
        <div class="fh5co-hero">
            <div class="fh5co-overlay">
                <div class="card">
                    <span class="title">Coupon check</span>
                    <div class="alert alert-danger" id="error-alert" style="display: none;">
                        The coupon has expired or is incorrect.
                    </div>
                    <div class="alert alert-success" id="success-alert" style="display: none;">
                        Coupon code successfully checked.
                    </div>
                    <form class="form" id="login-form">
                        <div class="group">
                            <input placeholder="‎" type="text" id="code" name="code">
                            <label for="code">Coupon code</label>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(../assets/images/background-coupons.jpg);"></div>
        </div>
        <?php
        require_once '../assets/php/includes/footer.php';
        ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery.easing.1.3.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.waypoints.min.js"></script>
<script src="../assets/js/jquery.stellar.min.js"></script>
<script src="../assets/js/hoverIntent.js"></script>
<script src="../assets/js/superfish.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
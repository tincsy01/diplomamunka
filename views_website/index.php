<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
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

<!--    <link rel="shortcut icon" href="favicon.ico">-->
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/icomoon.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/superfish.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--    <script src="../assets/js/modernizr-2.6.2.min.js"></script>-->
<!--    <script src="../assets/js/respond.min.js"></script>-->
    <script src="../assets/js/scripts/get_cities_index.js"></script>
    <script src="../assets/js/scripts/connection_checker.js"></script>
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
            <div class="fh5co-overlay"></div>
            <div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(../assets/images/backgroung.jpg);">
                <div class="desc animate-box">
                    <h2>Travel Around The World.</h2>
                    <span><a class="btn btn-primary btn-lg" href="make_tour.php">Get Started</a></span>
                </div>
            </div>
        </div>
        <div class="fh5co-listing">
            <div class="container">
                <div class="row cities">
                </div>
            </div>
        </div>
        <?php
        require_once '../assets/php/includes/footer.php';
        ?>
    </div>
</div>
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


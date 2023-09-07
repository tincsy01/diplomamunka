<?php
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
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
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="../../css/icomoon.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/superfish.css">
    <link rel="stylesheet" href="../../css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../../js/modernizr-2.6.2.min.js"></script>
    <script src="../../js/respond.min.js"></script>
<!--    <script src="../../js/scripts/registration.js"></script>-->
</head>
<body>
<header id="fh5co-header-section">
    <div class="container">
        <div class="nav-header">
            <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
<!--            <h1 id="fh5co-logo"><a href="../../../views_website/index.php">TenderTours</a></h1>-->
            <h1 id="fh5co-logo"><a href="./index.php">TenderTours</a></h1>
            <!-- START #fh5co-menu-wrap -->
            <nav id="fh5co-menu-wrap" role="navigation">
                <ul class="sf-menu" id="fh5co-primary-menu">
                    <?php
                    if(isset($_SESSION['permission'])){
                        switch ($_SESSION['permission']){
                            case 2:
                                echo'<li class="active">
                                        <a href="./index.php">Home</a>
                                    </li>';
                                echo'<li>
                                        <a href="./favourites.php">Favourites</a>
                                    </li>';
                                echo'<li>
                                        <a href="./cities.php">Cities</a>
                                    </li>';
                                echo' <li>
                                        <a href="#" class="fh5co-sub-ddown">Tours</a>
                                        <ul class="fh5co-sub-menu">
                                            <li><a href="./make_tour.php" target="_blank">Make a tour</a></li>
                                            <li><a href="./tours.php" target="_blank">My tours</a></li>
                                        </ul>
                                    </li>';
                                echo'<li>
                                        <a href="#">Log out</a>
                                    </li>';
                                break;
                            case 3:
                                echo'<li class="active">
                                        <a href="./index.php">Home</a>
                                    </li>';
                                echo' <li>
                                        <a href="#" class="fh5co-sub-ddown">Attractions</a>
                                        <ul class="fh5co-sub-menu">
                                            <li><a href="./make_attraction.php" target="_blank">Make an attraction</a></li>
                                            <li><a href="./attractions.php" target="_blank">My attractions</a></li>
                                        </ul>
                                    </li>';
//                                echo'<li>
//                                        <a href="#">Statistics</a>
//                                    </li>';
                                echo'<li>
                                        <a href="./logout.php">Log out</a>
                                    </li>';
                                break;
                            case 4 :
                                echo'<li class="active">
                                        <a href="./views_mobile/worker_index.php">Home</a>
                                    </li>';
                                echo'<li>
                                       <a href="./views_mobile/coupons.php">Coupons</a>
                                    </li>';
                                echo'<li>
                                       <a href="#">Statistics</a>
                                    </li>';
                                echo'<li>
                                        <a href="./views_website/logout.php">Log out</a>
                                    </li>';
                        }
                    }
                    else{
                        echo'<li class="active">
                                <a href="./index.php">Home</a>
                            </li>';
                        echo '<li>
                                <a href="./registration.php">Registration</a>
                            </li>';
                        echo '<li>
                                <a href="./login.php">Login</a>
                            </li>';
                    }

                    ?>
<!--                    <li class="active">-->
<!--                        <a href="../../../views_website/index.php">Home</a>-->
<!--                    </li>-->
<!--                    <li><a href="../../../views_website/registration.php">Registration</a></li>-->
<!--                    <li>-->
<!--                        <a href="listing.html" class="fh5co-sub-ddown">Listing</a>-->
<!--                        <ul class="fh5co-sub-menu">-->
<!--                            <li><a href="http://freehtml5.co/preview/?item=build-free-html5-bootstrap-template" target="_blank">Build</a></li>-->
<!--                            <li><a href="http://freehtml5.co/preview/?item=work-free-html5-template-bootstrap" target="_blank">Work</a></li>-->
<!--                            <li><a href="http://freehtml5.co/preview/?item=light-free-html5-template-bootstrap" target="_blank">Light</a></li>-->
<!--                            <li><a href="http://freehtml5.co/preview/?item=relic-free-html5-template-using-bootstrap" target="_blank">Relic</a></li>-->
<!--                            <li><a href="http://freehtml5.co/preview/?item=display-free-html5-template-using-bootstrap" target="_blank">Display</a></li>-->
<!--                            <li><a href="http://freehtml5.co/preview/?item=sprint-free-html5-template-bootstrap" target="_blank">Sprint</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#" class="fh5co-sub-ddown">Dropdown</a>-->
<!--                        <ul class="fh5co-sub-menu">-->
<!--                            <li><a href="left-sidebar.html">Web Development</a></li>-->
<!--                            <li><a href="right-sidebar.html">Branding &amp; Identity</a></li>-->
<!--                            <li>-->
<!--                                <a href="#" class="fh5co-sub-ddown">Free HTML5</a>-->
<!--                                <ul class="fh5co-sub-menu">-->
<!--                                    <li><a href="http://freehtml5.co/preview/?item=build-free-html5-bootstrap-template" target="_blank">Build</a></li>-->
<!--                                    <li><a href="http://freehtml5.co/preview/?item=work-free-html5-template-bootstrap" target="_blank">Work</a></li>-->
<!--                                    <li><a href="http://freehtml5.co/preview/?item=light-free-html5-template-bootstrap" target="_blank">Light</a></li>-->
<!--                                    <li><a href="http://freehtml5.co/preview/?item=relic-free-html5-template-using-bootstrap" target="_blank">Relic</a></li>-->
<!--                                    <li><a href="http://freehtml5.co/preview/?item=display-free-html5-template-using-bootstrap" target="_blank">Display</a></li>-->
<!--                                    <li><a href="http://freehtml5.co/preview/?item=sprint-free-html5-template-bootstrap" target="_blank">Sprint</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                            <li><a href="#">UI Animation</a></li>-->
<!--                            <li><a href="#">Copywriting</a></li>-->
<!--                            <li><a href="#">Photography</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a href="contact.html">Contact</a></li>-->
                </ul>
            </nav>
        </div>
    </div>
</header>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/jquery.easing.1.3.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery.waypoints.min.js"></script>
<script src="../../js/jquery.stellar.min.js"></script>
<script src="../../js/hoverIntent.js"></script>
<script src="../../js/superfish.js"></script>
<script src="../../js/main.js"></script>

</body>
</html>

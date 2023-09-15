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

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/icomoon.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/superfish.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <script src="../assets/js/modernizr-2.6.2.min.js"></script>
    <script src="../assets/js/respond.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="../assets/js/scripts/make_tour.js"></script>
    <script src="../assets/js/scripts/connection_checker.js"></script>

</head>
<body>
<div id="fh5co-wrapper">
    <div id="fh5co-page">
        <div id="fh5co-header">
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
                                        <a href="./logout.php">Log out</a>
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
                                            echo'<li>
                                        <a href="./logout.php">Log out</a>
                                    </li>';
                                            break;
                                        case 4 :
                                            echo'<li class="active">
                                        <a href="./index.php">Home</a>
                                    </li>';
                                            echo'<li>
                                       <a href="./coupons.php">Coupons</a>
                                    </li>';
                                            echo'<li>
                                       <a href="./statistic.php">Statistics</a>
                                    </li>';
                                            echo'<li>
                                       <a href="./complaints.php">Complaints</a>
                                    </li>';
                                            echo'<li>
                                        <a href="../views_website/logout.php">Log out</a>
                                    </li>';
                                    }
                                }
                                else{
                                    echo'<li class="active">
                                <a href="./index.php">Home</a>
                            </li>';
                                    echo '<li>
                                <a href="./cities.php">Cities</a>
                            </li>';
                                    echo '<li>
                                <a href="./registration.php">Registration</a>
                            </li>';
                                    echo '<li>
                                <a href="./login.php">Login</a>
                            </li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
        </div>
        <div class="fh5co-hero">
            <div class="fh5co-overlay">

                <div class="card user-logged-in">
                    <span class="title">Make your tour</span>
                    <form class="form" id="login-form">
                        <div class="group">
                            <select name="city" id="city" >
                                <option value="" disabled selected hidden >-- Select a city --</option>
                            </select>
                            <label for="city">City</label>
                        </div>
                        <div id="attractions">
                            <select class="js-example-basic-multiple" name="attraction_ids[]" multiple="multiple" >
                                <option value="" disabled selected hidden>Placeholder szöveg</option>
                            </select>

                        </div>
                        <div class="group">
                            <input placeholder="‎" type="date" id="date" name="date">
                            <label for="date">Date</label>
                        </div>
                        <div class="group">
                            <input placeholder="‎" type="time" id="time" name="time">
                            <label for="time">Time:</label>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
                <div class="card logout" style="display: none">
                    <span class="title">If you want to create a tour, log in</span>
                </div>
            </div>

            <div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(../assets/images/backgroung.jpg);">

            </div>
        </div>
        <?php
        require_once '../assets/php/includes/footer.php';
        ?>
    </div>
</div>
<!--<script src="../assets/js/jquery.min.js"></script>-->
<!--<script src="../assets/js/jquery.easing.1.3.js"></script>-->
<!--<script src="../assets/js/bootstrap.min.js"></script>-->
<!--<script src="../assets/js/jquery.waypoints.min.js"></script>-->
<!--<script src="../assets/js/jquery.stellar.min.js"></script>-->
<!--<script src="../assets/js/hoverIntent.js"></script>-->
<!--<script src="../assets/js/superfish.js"></script>-->
<!--<script src="../assets/js/main.js"></script>-->
</body>
</html>

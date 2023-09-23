<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cities</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="../assets/js/modernizr-2.6.2.min.js"></script>
    <script src="../assets/js/respond.min.js"></script>
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
            <div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(../assets/images/bg-3.jpg);">
                <div class="desc animate-box">
                    <h2>Edit your attractions!</h2>
                </div>
            </div>
        </div>
        <div class="fh5co-listing">
            <div class="container">
                <div class="row" id="AttractionList">
                    <div class="table-container">
                        <h1 style="color: white">Attractions</h1>
                        <table id="attractionsTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Number of Visitors</th>
                                <th>Popular</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="updateWindow" class="modal">
            <div class="cardUpdate">
                <div class="close">x</div>
                <span class="title">Update your city attraction</span>
                <form class="form" id="login-form" enctype="multipart/form-data">
                    <div class="group">
                        <input placeholder="‎" type="text" id="attraction" name="attraction">
                        <label for="attraction">Attraction name</label>
                    </div>
                    <div class="group">
                        <select name="category" id="category" >
                            <option value="" disabled selected hidden >-- Select a category --</option>
                        </select>
                        <label for="category">Category</label>
                    </div>
                    <div class="group">
                        <input placeholder="‎" type="text" id="longitude" name="longitude">
                        <label for="longitude">Longitude</label>
                    </div>
                    <div class="group">
                        <input placeholder="‎" type="text" id="lattitude" name="lattitude">
                        <label for="lattitude">Latitude</label>
                    </div>
                    <div class="group">
                        <textarea name="description" id="description" cols="25" rows="3" placeholder="‎"></textarea>
                        <label for="description">Description</label>
                    </div>
                    <button type="submit" class="update_save">Update</button>
                </form>
            </div>
        </div>
        <div class="questionWindow modals">
            <div class="close">x</div>
            <div class="picture">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>

                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                </svg>
            </div>
            <div class="text">
                <h4>Are you sure delete it?</h4>
                <button class="btn btn-danger btn-sm deleteConf">Delete</button>
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
<script src="../assets/js/scripts/get_attractions.js"></script>

</body>
</html>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange</title>
    <meta name="description" content="The solution for buying and selling textbooks.">
    <!-- JavaScript -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="includes/js/main.js"></script>
    <script src="includes/js/angular/BookXchange.js"></script>
    <script src="includes/js/angular/BookXchangeController.js"></script>
    <!--- Bootstrap CDN -->
    <link rel = "stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="includes/css/main.css">
    <link rel="stylesheet" href="includes/css/navbar.css">
    <!-- FakeLoader -->
    <link rel="stylesheet" href="bower_components/fakeLoader/fakeLoader.css">
    <script src="bower_components/fakeLoader/fakeLoader.min.js"></script>
    <!-- countTo -->
    <script src="bower_components/jquery-countTo/jquery.countTo.js"></script>
</head>
<body>
    
    <div id="fakeLoader"></div>

<!--    <div ng-app="BookXchange" ng-controller="BookXchangeController">-->
    <!-- Navigation Bar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" id="btn-collapsed" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">bookXchange</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="my-nav">
                <form class="navbar-form navbar-left" action = "searchByISBN.php" method = "POST">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" style="width:1%;">
                                <span class="glyphicon glyphicon-search"></span>
                            </span>
                            <input type="text" class="form-control" name = "isbn" placeholder="Find your perfect book here...">
                        </div>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php

                    header('Cache-Control: no-cache, no-store, must-revalidate');

                    require_once('includes/php/MySqlTools.php');
                    $db = new MySqlTools();
                    session_start();

                    if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
                    {
                        if(strcmp($db->getFingerprintInfoFromId($_SESSION['USER_ID']), $_SESSION['FINGER_PRINT']) == 0)
                        {
                            echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome ' . $db->getFName($_SESSION['USER_ID']) . ' <span class="caret"></span></a>';
                            echo '
                                <ul class="dropdown-menu">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="logout.php">Log out</a></li>
                                </ul>
                                </li>
                            ';
                        }
                    }
                    else
                    {
                        echo '
                                <li><a href="login.php">Log In</a></li>
                                <li><a href="register.php">Register</a></li>
                        ';
                    }
                        ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid parallax">
        <div class="row statistics">
            <div class="col-xs-18 col-sm-4 col-md-4">
                <img src="http://i.imgur.com/0pRdvCh.png" class="img-responsive" alt="Users Icon">
                <span class="timer" data-from="0" data-to="700" data-speed="2000"></span>
                <hr>
                <p>Registered Users</p>
            </div>
            <div class="col-xs-18 col-sm-4 col-md-4">
                <img src="http://i.imgur.com/AKyXyav.png" class="img-responsive" alt="Books Icon">
                <span class="timer" data-from="0" data-to="1000" data-speed="2000"></span>
                <hr>
                <p>Books Waiting to be Sold</p>
            </div>
            <div class="col-xs-18 col-sm-4 col-md-4">
                <img src="http://i.imgur.com/M9uBXnc.png" class="img-responsive" alt="Sold Icon">
                <span class="timer" data-from="0" data-to="2500" data-speed="2000"></span>
                <hr>
                <p>Books Sold So Far</p>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="container-fluid content sect1">
        <div class="row section-header">
            <span>How to Xchange</span>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-12">[  Buying  ]</div>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-1"></div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                <br>
                Enter ISBN in search bar at the top of the page
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                <br>
                Browse through results for your perfect book
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                <br>
                Contact seller
            </div>
            <div class="col-xs-18 col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-12">[  Selling  ]</div>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-1"></div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                <br>
                Go to your 'My Account' page
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                <br>
                Click on 'Posts' and add a new book
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-2">
                <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                <br>
                Wait for someone to contact you
            </div>
            <div class="col-xs-18 col-md-1"></div>
        </div>
    </div>

    <!-- Why Use This -->
    <div class="container content sect2">
        <div class="row section-header">
            <span>Why Use bookXchange?</span>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-1">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-5">
                <p class="brief">Search Function</p>
                <p class="description">
                    You can search for a specific book based on ISBN. No more browsing through every Facebook class page.
                </p>
            </div>
            <div class="col-xs-18 col-md-1">
                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-5">
                <p class="brief">Convenient</p>
                <p class="description">
                    Buy/sell books from/to students at your own school. No more shipping fees.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-1">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-5">
                <p class="brief">Faster</p>
                <p class="description">
                    No more waiting in the book buyback lines and for your book to arrive.
                </p>
            </div>
            <div class="col-xs-18 col-md-1">
                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            </div>
            <div class="col-xs-18 col-md-5">
                <p class="brief">Pick Your Price</p>
                <p class="description">
                    If you're a buyer, you can pick the book based on your budget. If you're a seller, you can sell your book for your own price.
                </p>
            </div>
        </div>
    </div>

    <!-- Send Us Feedback
    <div class="container-fluid content sect3">
        <div class="row section-header">
            <span>Send Us Feedback</span>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-12">Buying</div>
        </div>
        <div class="row">
            <div class="col-xs-18 col-md-6">1.</div>
            <div class="col-xs-18 col-md-6">
                Enter ISBN in search bar at the top of the page
            </div>
        </div>
    </div>
    -->
    
    <!-- Footer -->
    <div class="container-fluid footer">
        <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
        <span class="footer-desc">
            2016 bookXchange All rights reserved. Designed and coded with love by 
            <a href="http://cs480-projects.github.io/teams-fall2016/WebHeads/index.html">
                &lt;WebHeads/&gt;
            </a>
            .
        </span>
    </div>

    <!-- Initialize fakeLoader
    <script type="text/javascript">
        $("#fakeLoader").fakeLoader({
            timeToHide: 2000, // fakeLoader time (ms)
            spinner:"spinner1", // Options: 'spinner1' to 7
            bgColor:"#2ecc71" //Hex, RGB or RGBA colors
        });
    </script>
-->
<!--    </div>-->

</body>
</html>

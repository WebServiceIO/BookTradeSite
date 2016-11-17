<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange | Change Your Username</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Christine Nguyen Tanner Summers Giovanni Hernandez David Ghermezi">
    <meta name="description" content="The solution for buying and selling textbooks.">
    <meta name="keywords" content="bookxchange christine nguyen tanner summers giovanni hernandez david ghermezi">
    <!-- CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/navbar.css">
    <link rel="stylesheet" href="includes/css/editContent.css">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="includes/js/navbar.js"></script>
</head>
<body>

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
            <form class="navbar-form navbar-left" action = "book_results.php" method = "POST">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" style="width:1%;">
                            <button type="submit" class="btn btn-link">
                                <span class="glyphicon glyphicon-search"></span>&nbsp;
                            </button>
                        </span>
                        <input type="text" class="form-control" name = "isbn" placeholder="Find your perfect book here...">
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">

                <?php

                header('Cache-Control: no-cache, no-store, must-revalidate');

                require_once('includes/php/db_util.php');
                $db = new DBUtilities();
                session_start();


                if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
                {
                    if(strcmp($db->getFingerprintInfoFromId($_SESSION['USER_ID']), $_SESSION['FINGER_PRINT']) == 0)
                    {
                        echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome ' . $db->getFName($_SESSION['USER_ID']) . ' <span class="caret"></span></a>';
                        echo '
                                <ul class="dropdown-menu">
                                    <li><a href="home.php">Your Account</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="create_post.php">Add Book to Sell</a></li>
                                    <li role="separator" class="divider"></li>
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

<!-- Start of Page Content -->
<div id="wrapper-content">
    <div class="container">
        <h1>Change Your Username</h1>
        <p class="warning">
            Click the 'Submit' button when you are finished or click
            the 'Cancel' button to go back to your account page.
        </p>

        <form>
            <div class="form-group">
                <input type="text" class="form-control" id="username" aria-describedby="newUsername" placeholder="Enter new username" value="username goes here">
            </div>
            <div class="row">
                <div class="col-xs-6 form-link">
                    <a href="home.php" class="btn btn-default btn-transparent">Cancel</a>
                </div>
                <div class="col-xs-6 form-link">
                    <button type="submit" class="btn btn-default btn-transparent">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<div class="container-fluid footer">
    <span class="footer-desc">
        Designed and coded with love by
        <a href="http://cs480-projects.github.io/teams-fall2016/WebHeads/index.html">
            &lt;WebHeads/&gt;
        </a>
        .
    </span>
</div>

</body>
</html>
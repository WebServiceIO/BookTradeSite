<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Christine Nguyen Tanner Summers Giovanni Hernandez David Ghermezi">
    <meta name="description" content="The solution for buying and selling textbooks.">
    <meta name="keywords" content="bookxchange christine nguyen tanner summers giovanni hernandez david ghermezi">
    <!-- CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/navbar.css">
    <link rel="stylesheet" href="includes/css/account.css">
    <link rel = "stylesheet" href = "includes/css/datatables1.10.12/jquery.dataTables.min.css?v=1.0">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="includes/js/navbar.js"></script>
    <script type="text/javascript" src="includes/js/account.js"></script>
    <script src = "includes/js/datatables1.10.12/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="includes/js/tables/user_posts_data_tables.js"></script>
</head>
<body>

<?php
//require_once('includes/php/config.php');
require_once('includes/php/db_util.php');
// start a session
session_start();

$user_id = -1;

if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
{
    header('Location:' . site_root);
}
else
{
    $user_id = $_SESSION['USER_ID'];
    $db_connection = new DBUtilities();
}
?>

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
                                <span class="glyphicon glyphicon-search"></span>
                            </span>
                        <input type="text" class="form-control" name = "isbn" placeholder="Find your perfect book here...">
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!--Start of Page Content-->

<!-- Old Code - Revert Back To This If Can't Work With New Design-->
<!--
<div id="page-content-wrapper">
    <div id="profile">
        <h1 class="content-header">Your Profile</h1>

        <h3 class="edit-header">Edit Account Information</h3>
        <p class="profile-prompt">Username: <?php $db_connection->getUserNameFromID($user_id)?></p>
    </div>
    <div id="posts">
        <h1 class="content-header">Your Posts</h1>
        <h3 class="edit-header">Your Books</h3>
        <table id="user_post_datatable" class="display" cellspacing="0"></table>
        <a href="#">
            <button type="button" class="btn btn-primary" id="btn-sell">
            </button>
        </a>
    </div>
</div>
-->

<div id="wrapper-content">
    <div class="container">
        <h1>Your Account</h1>
    </div>
    <div class="container border">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xs-18 section-header">Profile</div>
                    <div class="col-xs-18 section-description">Username & Password</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xs-18 subsection-header">Edit Account Information</div>
                    <div class="col-xs-18">
                        <a href="editUsername.php" class="link">Username</a>
                    </div>
                    <div class="col-xs-18"><a href="#" class="link">Password</a></div>
                    <div class="col-xs-18"><a href="#" class="link">Contact Information</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container border">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xs-18 section-header">Books</div>
                    <div class="col-xs-18 section-description">View & Add Books</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xs-18 subsection-header">Your Books</div>
                    <div class="col-xs-18"><a href="create_post.php" class="link">Sell Another Book</a></div>
                    <div class="col-xs-18"><a href="#" class="link">View Your Books</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

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

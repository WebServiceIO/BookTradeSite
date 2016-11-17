<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange | Results</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/includes/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/includes/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/includes/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/includes/images/favicons/manifest.json">
    <link rel="shortcut icon" href="/includes/images/favicons/favicon.ico">
    <meta name="msapplication-config" content="/includes/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Meta Tags -->
    <meta name="author" content="Christine Nguyen Tanner Summers Giovanni Hernandez David Ghermezi">
    <meta name="description" content="The solution for buying and selling textbooks.">
    <meta name="keywords" content="bookxchange christine nguyen tanner summers giovanni hernandez david ghermezi">
    <!-- CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/navbar.css">
    <link rel="stylesheet" href="includes/css/results.css">
    <link rel="stylesheet" href="includes/css/datatables1.10.12/jquery.dataTables.min.css?v=1.0">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="includes/js/navbar.js"></script>
    <script src="includes/js/result.js"></script>
    <script src="includes/js/datatables1.10.12/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="includes/js/tables/results_post_data_tables.js"></script>
</head>
<body>

<?php

//include_once ('includes/php/config/config.php');
include_once ('includes/php/db_util.php');
session_start();

if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']) || !isset($_POST['isbn']))
{
    header('Location:' . site_root);
}

$db_connection = new DBUtilities();

// TODO     PARSE ISBN NUMBER HERE

$isbn_id = $db_connection->getIsbnIdFromIsbn($_POST['isbn']);
$_SESSION['isbn_id'] = $isbn_id;

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

<div id="content_wrapper">

    <h3>Good</h3>
    <div class="display datatables_template">
        <table id="condition_good_datatable" class="display" cellspacing="0"></table>
    </div>

    <h3>Poor</h3>
    <div class="display datatables_template">
        <table id="condition_poor_datatable" class="display" cellspacing="0"></table>
    </div>

    <h3>Ok</h3>
    <div class="display datatables_template">
        <table id="condition_ok_datatable" class="display" cellspacing="0"></table>
    </div>

    <h3>Acceptable</h3>
    <div class="display datatables_template">
        <table id="condition_acceptable_datatable" class="display" cellspacing="0"></table>
    </div>

    <h3>Excellent</h3>
    <div class="display datatables_template">
        <table id="condition_excellent_datatable" class="display" cellspacing="0"></table>
    </div>

    <h3>New</h3>
    <div class="display datatables_template">
        <table id="condition_new_datatable" class="display" cellspacing="0"></table>
    </div>
</div>

</body>
</html>
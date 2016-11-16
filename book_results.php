<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Bookxchange: ISBN</title> <!-- PHP -->
        <meta name="description" content="The solution for buying and selling textbooks.">

        <!--- Bootstrap CDN -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/includes/css/datatables1.10.12/datatables.css">
        <script src = "includes/js/jquery1.11.1/jquery.min.js"></script>
        <script src = "includes/js/bootstrap3.3.4/bootstrap.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="includes/css/results.css">

        <!-- JavaScript -->
        <script src="includes/js/result.js"></script>

        <script src = "includes/js/datatables1.10.12/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="includes/js/tables/results_post_data_tables.js"></script>
        <link rel = "stylesheet" href = "includes/css/datatables1.10.12/jquery.dataTables.min.css?v=1.0">
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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-search">
                    <form class="navbar-form navbar-left">
                        <span class="v-line"></span>
                        <!-- Submit button for form -->
                        <button type="submit" class="btn btn-default search-submit">
                            <img src="http://i.imgur.com/3iGPcKb.png" alt="icon-search" />
                        </button>
                        <!-- User input form -->
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Find your perfect book here...">
                        </div>
                    </form>
                    <span class="v-line"></span>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>Your Books</li>
                                <li role="separator" class="divider"></li>
                                <li>Sign Out</li>
                            </ul>
                        </li>
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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange | Edit Contact Information</title>
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

<?php
header('Cache-Control: no-cache, no-store, must-revalidate');

require_once('includes/php/db_util.php');
$db = new DBUtilities();
session_start();
$condition = 0;

if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
{
    header('Location:' . site_root);
    die();
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
                            <button type="submit" class="btn btn-link">
                                <span class="glyphicon glyphicon-search"></span>&nbsp;
                            </button>
                        </span>
                        <input type="text" class="form-control" name = "isbn" placeholder="Find your perfect book here...">
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Start of Page Content -->
<div id="wrapper-content">
    <div class="container">
        <h1>Edit Contact Information</h1>
        <p class="warning">
            All of your contact information will be displayed on your book post.
            Click the 'Submit' button when you are finished or click the 'Cancel'
            button to go back to your account page.
        </p>

        <form id="edit_contact_form" name="edit_contact" action =" <?php htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method = "post" >
<!--            <div class="form-group">-->
<!--                <input type="text" class="form-control" id="phoneNum" aria-describedby="phoneNum" placeholder="Enter your phone number">-->
<!--            </div>-->
<!--            <div class="form-check">-->
<!--                <label class="form-check-label">-->
<!--                    <input type="checkbox" class="form-check-input">-->
<!--                    Call-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="form-check">-->
<!--                <label class="form-check-label">-->
<!--                    <input type="checkbox" class="form-check-input">-->
<!--                    Text-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter your e-mail address">-->
<!--            </div>-->
            <div class="form-group">
                <?php
                if(isset($_POST['contact_info']))
                {
                    if(empty($_POST['contact_info']))
                    {
                        echo '<h3 style="background-color:red;"> Please enter contact information </h3>';
                    }
                    else
                    {
                        $condition = 1;
                    }
                }

                if($condition == 1)
                {
                    if($db->changeContactInfo(trim($_POST['contact_info']), $_SESSION['USER_ID']))
                    {
                        $previous_page = "javascript:history.go(-1)";

                        if(isset($_SERVER['HTTP_REFERER'])) {
                            $previous_page = $_SERVER['HTTP_REFERER'];
                        }
                        header('Cache-Control: no-cache, no-store, must-revalidate');
                        header('Location:' .  account);
                        die();
                    }
                    else
                    {
                        echo '<h3 style="background-color:red;"> An error has occurred </h3>';
                    }
                }
                ?>
<!--                <input type="text" class="form-control" id="contact_info" name="contact_info" aria-describedby="new_contact_info" placeholder="Enter your contact information">-->
                <textarea class="form-control" id="contact_info" name="contact_info" rows="5"></textarea>
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
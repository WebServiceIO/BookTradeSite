<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange | Book Information</title>
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
    <link rel="stylesheet" href="includes/css/bookResult.css">
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
                                <li><a href="view_books.php">View Your Books</a></li>
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

<?php

require_once('includes/php/db_util.php');
require_once('includes/php/db_tables/post.php');
$post = null;
$db_connection = new DBUtilities();
session_start();

// TODO find alternative way besides switching between session post id and post post_id
if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']) && (isset($_SESSION['post_id'])) || isset($_POST['post_id']))
{
    if(!empty($_SESSION['post_id']))
    {
        $post = $db_connection->getUserPost($_SESSION['post_id']);
        // TODO if unset, refreshing doesnt work, need to use get or find an alternative way
        //unset($_SESSION['post_id']);
    }
    else if(!empty($_POST['post_id']))
    {
        $post = $db_connection->getUserPost($_POST['post_id']);
        // TODO if unset, refreshing doesnt work, need to use get or find an alternative way
        //unset($_SESSION['post_id']);
    }
    else
    {
        header('Location:' . site_root);
    }
}
else
    header('Location:' . site_root);

?>

<?php if($post != null) : ?>

    <div class="container wrapper">
        <a href="#">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span>Back to Results</span>
        </a>

        <h1>
            <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
            <?php echo $db_connection->getIsbnFromPostID($post->getPostId()); ?>
        </h1>
        <hr>
        <h2>Product Information</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-6">Price</div>
                <div class="col-md-6"><?php echo $post->getPrice(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Condition</div>
                <div class="col-md-6"><?php echo $post->getItemCondition(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Comments</div>
                <div class="col-md-6"><?php echo $post->getComments(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Title</div>
                <div class="col-md-6"><?php echo $post->getTitle(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Author</div>
                <div class="col-md-6"><?php echo $post->getAuthor(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Edition</div>
                <div class="col-md-6"><?php echo $post->getEdition(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Class</div>
                <div class="col-md-6"><?php echo $post->getClass(); ?></div>
            </div>
        </div>

        <h2>Seller Information</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-6">Seller</div>
                <div class="col-md-6"><?php echo $db_connection->getUserNameFromID($post->getUserId()); ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Contact</div>
                <div class="col-md-6"><?php echo $post->getContact(); ?></div>
            </div>
        </div>
    </div>

<?php else : ?>

    <h1>Post no longer exist</h1>

<?php endif; ?>

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
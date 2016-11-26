<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange</title>
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
    <link rel="stylesheet" href="includes/css/createPost.css">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="includes/js/navbar.js"></script>
    <script type="text/javascript" src="includes/js/footer.js"></script>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="home.php">Your Account</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();


if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
{
    header('Location:' . site_root);
    die();
}



require_once ('includes/php/db_util.php');
require_once ('includes/php/config/config.php');

require_once('includes/php/validation/validation.php');

$validation = new Validation();

$db_connection = new DBUtilities();
$isbn = null;
$user_id = $_SESSION['USER_ID'];
$conditions = Array('isbn' => false, 'price' => false);

ob_start();
?>
<div id="wrapper-content">
    <div class="container">
        <h1>Add New Book</h1>
        <form action="<?php htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method="post">
            <?php
            if(isset($_POST['isbn']))
            {
                if(empty($_POST['isbn']))
                {
                    echo '<h3 style="background-color:red;"> Please enter the ISBN number </h3>';
                }
                else
                {
                    $result = $validation->isbn_validate_and_format($_POST['isbn']);

                    if(!$result['CONDITION'])
                    {
                        echo '<h3 style="background-color:red;">' . $result['ERROR'] . '</h3>';
                    }
                    else
                    {
                        $isbn = $result['RESULT'];
                        $conditions['isbn'] = true;
                    }
                }
            }
            ?>
            <div class="form-group">
                <input type="text" name="isbn" class="form-control form-content" id="inputISBN" aria-describedby="enterISBNOfBook" placeholder="ISBN**"  value="<?php if(isset($_POST['isbn'])) {echo $_POST['isbn']; }?>">
            </div>
            <div class="form-group">
                <input type="text" name="title" class="form-control form-content" id="inputTitle" aria-describedby="enterTitleOfBook" placeholder="Title"  value="<?php if(isset($_POST['title'])) {echo $_POST['title']; }?>">
            </div>
            <div class="form-group">
                <input type="text" name="class" class="form-control form-content" id="inputClass" aria-describedby="enterClass" placeholder="Class Used For"  value="<?php if(isset($_POST['class'])) {echo $_POST['class']; }?>">
            </div>
            <div class="form-group">
                <input type="text" name="author" class="form-control form-content" id="inputAuthor" aria-describedby="enterAuthor" placeholder="Author"  value="<?php if(isset($_POST['author'])) {echo $_POST['author']; }?>">
            </div>
            <div class="form-group">
                <input type="text" name="edition" class="form-control form-content" id="inputEdition" aria-describedby="enterEdition" placeholder="Edition"  value="<?php if(isset($_POST['edition'])) {echo $_POST['edition']; }?>">
            </div>
            <?php
            if(isset($_POST['price']))
            {
                if(empty($_POST['price']))
                {
                    echo '<h3 style="background-color:red;">  Please enter the book\'s price </h3>';
                }
                else
                {
                    $result = $validation->price_validate($_POST['price']);

                    if(!$result['CONDITION'])
                    {
                        echo '<h3 style="background-color:red;">' . $result['ERROR'] . '</h3>';
                    }
                    else
                    {
                        $conditions['price'] = true;
                    }
                }
            }
            ?>
            <div class="form-group">
                <input type="number" name="price" class="form-control form-content" id="inputPrice" aria-describedby="enterPrice" placeholder="Price**" value="<?php if(isset($_POST['price'])) {echo $_POST['price']; }?>">
            </div>
            <div class="form-group">
                <label for="condition">Condition</label>
                <?php
                if(isset($_POST['condition']))
                {
                    if(empty($_POST['condition']))
                    {
                        echo '<h3 style="background-color:red;">  Please enter the book\'s condition </h3>';
                    }
                }
                ?>
                <select class="form-control form-content" id="condition" name="condition">
                    <option value="Select_one" disabled selected>Select one</option>
                    <option value="New">New</option>
                    <option value="Excellent">Excellent</option>
                    <option value="Good">Good</option>
                    <option value="Acceptable">Acceptable</option>
                    <option value="Poor">Poor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comments">Comments</label>
                <small id="commentsHelp" class="form-text text-muted">Is there anything you want to say about your book, method of contact, etc.?</small>
                <textarea class="form-control form-content" id="comments" rows="3" name="comments"><?php if(isset($_POST['comments'])) {echo $_POST['comments']; }?></textarea>
            </div>
            <button type="submit" class="btn btn-default btn-transparent">Submit</button>
        </form>
        <?php



        if (!empty($_POST['isbn']) && !empty($_POST['price']) && !empty($_POST['condition']) && $isbn != null)
        {

            if($conditions['price'] && $conditions['isbn'])
            {

                $post_results = $db_connection->addPost($user_id, trim($isbn), trim($_POST['title']), trim($_POST['author']), trim($_POST['edition']), trim($_POST['class']), trim($_POST['price']), $_POST['comments'], $_POST['condition']);

                $_SESSION['post_id'] = $post_results['post_id'];

                if ($post_results['condition'])
                {
                    ob_end_clean();
                    header('Location:' . indiv_root);
                }
                else
                {

                    echo '<h3 style="background-color:red;"> An Error has occurred. Please try again later </h3>';
                }
            }
            else
                echo '<h3 style="background-color:red;"> lease provide required fields</h3>';

        }


        ?>
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
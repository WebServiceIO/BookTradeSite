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
    <link rel="stylesheet" href="includes/css/bookResult.css">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="includes/js/bookResultCarousel.js"></script>
</head>
<body>


    <?php

    require_once('includes/php/db_util.php');
    require_once('includes/php/db_tables/post.php');
    $post = null;
    $db_connection = new DBUtilities();

    session_start();

    if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']) && isset($_SESSION['post_id']))
    {
        if(!empty($_SESSION['post_id']))
        {
            $post = $db_connection->getUserPost($_SESSION['post_id']);
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


    <div class="container">
        <div class="carousel slide article-slide" id="myCarousel">
            <div class="carousel-inner cont-slider">
                <div class="item active">
                    <img src="http://placehold.it/1200x440/cccccc/ffffff">
                </div>
                <div class="item">
                    <img src="http://placehold.it/1200x440/999999/cccccc">
                </div>
                <div class="item">
                    <img src="http://placehold.it/1200x440/dddddd/333333">
                </div>
            </div>

            <!-- Indicators -->
            <ol class="carousel-indicators visible-lg visible-md">
                <li class="active" data-slide-to="0" data-target="#myCarousel">
                    <img alt="" title="" src="http://placehold.it/120x44/cccccc/ffffff">
                </li>
                <li class="" data-slide-to="1" data-target="#myCarousel">
                    <img alt="" title="" src="http://placehold.it/120x44/999999/cccccc">
                </li>
                <li class="" data-slide-to="2" data-target="#myCarousel">
                    <img alt="" title="" src="http://placehold.it/120x44/dddddd/333333">
                </li>
            </ol>
        </div>
    </div>



    <div id = 'seller'><h4> Seller: <?php echo $db_connection->getUserNameFromID($post->getUserId()); ?></h4></div>
    <div id = 'isbn'><h4> ISBN: <?php echo $db_connection->getIsbnFromPostID($post->getPostId()); ?></h4></div>
    <div id = 'price'><h4> Price: <?php echo $post->getPrice(); ?></h4></div>
    <div id = 'comments'><h4> Comments: <?php echo $post->getComments(); ?></h4></div>
    <div id = 'contact'><h4> Contact: <?php echo $post->getContact(); ?></h4></div>

    <?php else : ?>

        <h1>Post no longer exist</h1>

    <?php endif; ?>

</body>

</html>



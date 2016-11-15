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

    <?php

    require_once('includes/php/db_util.php');
    require_once('includes/php/db_tables/post.php');

    if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
    {
        if(isset($_POST['post_id']) && !empty($_POST['post_id']))
        {
            $db_connection = new DBUtilities();
            // TODO error check here, error page if postdoesnt exist
            $post = $db_connection->getUserPost($_POST['post_id']);
        }
        else
        {
            header('Location:' . site_root);
        }
    }
    else
        header('Location:' . site_root);

    ?>




    <p id = 'isbn'><?php var_dump($db_connection->getUserNameFromID($post->getIsbnId())) ;?></p>
    <p id = 'seller'><?php $db_connection->getUserNameFromID($post->getUserId()); ?></p>
    <p id = 'price'><?php echo $post->getPrice(); ?></p>
    <p id = 'comments'><?php echo $post->getComments(); ?></p>
    <p id = 'contact'><?php echo $post->getContact(); ?></p>





</body>

</html>



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
    isbn();
    seller();
    price();
    comments();
    contact();
?>



</body>

</html>

<?php
require_once './includes/config/db_injection.php';

$db = DataBaseLoader::connect();

function retrieveFromDB(){
  $tablename ="";
  $id = "";

  $statement = $db->prepare("SELECT * FROM $tablename WHERE id = '$id'");
  $result = $statement->execute();

}

function data(){
  return array("isbn" => "123456", "seller" => "Hello", "price" => "20","comments" => "slight wear and tear", "contact" => "626-251-0594");
}

function isbn(){
  $isbn = data()['isbn'];
  echo "<p id = 'isbn'>ISBN: $isbn </p>";
}

function seller(){
  $seller = data()['seller'];
  echo "<p id = 'seller'>Sold By: $seller </p>";
}

function price(){
  $price = data()['price'];
  echo "<p id = 'price'>Price: $price </p>";
}

function comments(){
  $comments = data()['comments'];
  echo "<p id = 'comments'>Comments: $comments </p>";
}

function contact(){
  $contact = data()['contact'];
  echo "<p id = 'contact'>Contact: $contact </p>";
}
?>

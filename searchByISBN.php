
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange: ISBN</title> <!-- PHP -->
    <meta name="description" content="The solution for buying and selling textbooks.">

    <!--- Bootstrap CDN -->
    <link rel = "stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="includes/css/results.css">

    <!-- JavaScript -->
    <script src="includes/js/result.js"></script>
</head>
<body>

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










<?php
  require_once "includes/php/included_classes.php";
    $db = db_loader::connect();
//    if(!empty($_POST['isbn'])){
//        $isbn = $_POST['isbn'];
//    }
//    if(!empty($_POST['title'])) {
//        $title = $_POST['title'];
//    }
//    if(!empty($_POST['author'])) {
//        $author = $_POST['author'];
//    }
searchISBN();
//    try {
//        $statement = $db->prepare("SELECT * FROM book WHERE seller = 'also me'");
//        $statement->execute();
//        $result = $statement->fetch(PDO::FETCH_ASSOC);
//        echo($result['id']." ".$result['title']." ".$result['author']." ".$result['isbn']);
//    }catch(PDOException $e){
//        echo "failure";
//    }
function searchISBN(){
    echo '<div id="wrapper">
            
            <!-- Brand New Results -->
            <div class="container">
                <h1 class="section-header">Brand New</h1>
                <table id="brand-new">
                    <tr>
                        <th>Price</th>
                        <th>Seller</th>
                        <th>Pictures</th>
                        <th>Comments</th>
                        <th>Contact</th>
                    </tr>';
    try {
        global $db;//,$isbn;
        $isbn = '012-87456523';
        $statement = $db->prepare("SELECT * FROM book WHERE isbn = '$isbn'");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $seller = $result['seller'];
        echo "<tr>
                        <td>$100</td> 
                        <td>$seller</td> 
                        <td>TBD</td> 
                        <td>No scratches</td> 
                        <td>Text @ (555)-123-1234</td> 
                    </tr>";
        echo '</table>
            </div>';

    } catch (PDOException $e) {
        echo "error";
    }
}

//function searchTitle(){
//    try{
//        global $db,$title;
//        $statement = $db->prepare("SELECT * FROM books WHERE title = '$title'");
//        $statement->execute();
//        $result = $statement->fetch(PDO::FETCH_ASSOC);
//
//
//    }catch (PDOException $e){
//        echo "error in title";
//    }
//}
//
//function searchAuthor(){
//    try{
//        global $db, $author;
//        $statement = $db->prepare("SELECT * FROM books WHERE author = '$author'");
//        $statement->execute();
//        $result = $statement->fetch(PDO::FETCH_ASSOC);
//    }catch(PDOException $e){
//        echo "error in author";
//    }
//}
//
//function searchTitleAuthor(){
//    try{
//        global $db, $author, $title;
//        $statement = $db->prepare("SELECT * FROM books WHERE author = '$author', title = 'title'");
//        $statement->execute();
//        $statement->setFetchMode(PDO::FETCH_ASSOC);
//        echo '<div class="container">
//                <h1 class="section-header">Brand New</h1>
//                <table id="brand-new">
//                <tr>
//                        <th>Price</th>
//                        <th>Seller</th>
//                        <th>Pictures</th>
//                        <th>Comments</th>
//                        <th>Contact</th>
//                    </tr>';
//        $result = $statement->fetch();
//        while($result){
//            echo '<tr>
//                        <td>$100</td> <!-- PHP -->
//                        <td>Christine</td> <!-- PHP -->
//                        <td>Christine</td> <!-- PHP -->
//                        <td>No scratches</td> <!-- PHP -->
//                        <td>Text @ (555)-123-1234</td> <!-- PHP -->
//                    </tr>';
//        }
//
//    }catch (PDOException $e){
//
//    }
//}
//?>

</body>
</html>

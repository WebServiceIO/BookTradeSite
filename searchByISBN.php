
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange: ISBN</title> <!-- PHP -->
    <meta name="description" content="The solution for buying and selling textbooks.">

    <!--- Bootstrap CDN -->
    <link rel = "stylesheet" href = "includes/css/bootstrap3.3.4/bootstrap.min.css">
    <script src = "includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src = "includes/js/bootstrap3.3.4/bootstrap.min.js"></script>

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
    // $db = DataBaseLoader::connect();
    // if(!empty($_POST['isbn'])){
    //     $isbn = $_POST['isbn'];
    // }
    //
    // searchISBN();
echo '<div id ="wrapper">';
    div_container("Acceptable","acceptable");
echo '</table></div></div>';
    function searchISBN(){
        $new = 0;
        $likenew = 0;
        $verygood = 0;
        $good = 0;
        $acceptable = 0;

        try {
            global $db,$isbn;
            $statement = $db->prepare("SELECT * FROM books WHERE isbn = '$isbn' ORDER BY conditions");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            echo '<div id="wrapper">';

            while($result != false) {
          //conditions should be 4 for acceptable
              if($result['conditions'] == 'Acceptable'){
                if($acceptable == 0){

                  $section_header = "Acceptable";
                  $id = "acceptable";
                  div_container($section_header,$id);


                    // echo '<!-- Acceptable Results -->
                    //         <div class="container">
                    //             <h1 class="section-header">Acceptable</h1>
                    //                 <table id="acceptable">
                    //                     <tr>
                    //                         <th>Price</th>
                    //                         <th>Seller</th>
                    //                         <th>Pictures</th>
                    //                         <th>Comments</th>
                    //                         <th>Contact</th>
                    //                     </tr>';
                  $acceptable = 1;
                }
                printNew($result['price'], $result['seller'],"TBD",$result['comments'],$result['contact']);
            }
//conditions should be 3 for good
            else if($result['conditions'] == 'Good'){
                if($acceptable == 1){
                    echo '</table></div>';
                    $acceptable = 2;
                }
                if($good == 0){

                  $section_header = "Good";
                  $id = "good";
                  div_container($section_header,$id);

                    // echo '<!-- Good Results -->
                    //         <div class="container">
                    //             <h1 class="section-header">Good</h1>
                    //                 <table id="good">
                    //                     <tr>
                    //                         <th>Price</th>
                    //                         <th>Seller</th>
                    //                         <th>Pictures</th>
                    //                         <th>Comments</th>
                    //                         <th>Contact</th>
                    //                     </tr>';
                  $good = 1;
                }

                printNew($result['price'], $result['seller'],"TBD",$result['comments'],$result['contact']);
            }
//conditions should be 1 for like New
            else if($result['conditions'] == 'Like New'){
                if($good == 1){
                    echo '</table></div>';
                    $good = 2;
                }
                if($likenew == 0) {

                  $section_heaader = "Like New";
                  $id = "like-new";
                  div_container($section_header,$id);
                    // echo '<!-- Like New Results -->
                    //         <div class="container">
                    //              <h1 class="section-header">Like New</h1>
                    //                  <table id="like-new">
                    //                     <tr>
                    //                         <th>Price</th>
                    //                         <th>Seller</th>
                    //                         <th>Pictures</th>
                    //                         <th>Comments</th>
                    //                         <th>Contact</th>
                    //                     </tr>';
                  $likenew =1;
                }
                printNew($result['price'], $result['seller'],"TBD",$result['comments'],$result['contact']);
            }
//conditions should be 0 for brand new
            else if($result['conditions'] == "New") {
                if($likenew == 1){
                    echo '</table></div>';
                    $likenew = 2;
                }
                if($new == 0){

                  $section_header = "Brand New";
                  $id = "brand-new";
                  div_container($section_header,$id);
                    // echo '<!-- Brand New Results -->
                    //          <div class="container">
                    //             <h1 class="section-header">Brand New</h1>
                    //                  <table id="brand-new">
                    //                     <tr>
                    //                         <th>Price</th>
                    //                         <th>Seller</th>
                    //                         <th>Pictures</th>
                    //                         <th>Comments</th>
                    //                         <th>Contact</th>
                    //                     </tr>';
                  $new = 1;
                }
                printNew($result['price'], $result['seller'],"TBD",$result['comments'],$result['contact']);

            }
//conditions should be 2 for very good
            else if($result['conditions'] == 'Very Good'){
                if($new == 1){
                    echo '</table></div>';
                    $new = 2;
                }
                if($verygood == 0){

                  $section_header = "Very Good";
                  $id = "very-good";
                  div_container($section_header,$id);

                    // echo '<!-- Very Good Results -->
                    //         <div class="container">
                    //             <h1 class="section-header">Very Good</h1>
                    //                 <table id="very-good">
                    //                     <tr>
                    //                         <th>Price</th>
                    //                         <th>Seller</th>
                    //                         <th>Pictures</th>
                    //                         <th>Comments</th>
                    //                         <th>Contact</th>
                    //                     </tr>';
                    $verygood = 1;
                }

                printNew($result['price'], $result['seller'],"TBD",$result['comments'],$result['contact']);
            }


            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        if($acceptable == 1 || $good == 1 || $likenew == 1 || $new == 1 || $verygood == 1){
            echo '</table></div>';
        }
        echo '</div>';

    } catch (PDOException $e) {
        echo "error";
    }
}


function div_container($section_header, $id){
  echo "<div class='container'>
            <h1 class='section-header'>$section_header</h1>
                <table id=$id>
                      <tr>
                          <th>Price</th>
                          <th>Seller</th>
                          <th>Pictures</th>
                          <th>Comments</th>
                          <th>Contact</th>
                      </tr>";
}
function printNew($price,$seller,$images,$comments,$contact){
    echo "<tr>
             <td>$price</td>
             <td>$seller</td>
             <td>$images</td>
             <td>$comments</td>
             <td>$contact</td>
          </tr>";
}
?>

</body>
</html>

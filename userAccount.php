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
    <link rel="stylesheet" href="includes/css/account.css">

    <!-- JavaScript -->
    <script type="text/javascript" src="includes/js/account.js"></script>
</head>
<body>

<?php

require_once ('includes/php/config.php');
require_once('includes/php/MySqlTools.php');
// start a session
session_start();
$db_connection = new MySqlTools();

//
//if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
//{
//    header('Location: site_root');
//}
//else
//{
//    $user_id = $_SESSION['USER_ID'];
//
//}

$user_id = 1;

?>


<!-- Navigation Bar -->
<div id="sidebar">
    <h1 id="sidebar-header">My Account</h1>
    <a href="#" class="nav-link active-link" id="profile-link">Your Profile</a>
    <a href="#" class="nav-link" id="posts-link">Posts</a>
</div>

<!-- Start of Page Content -->
<div id="page-content-wrapper">

    <div id="profile">
        <h1 class="content-header">Your Profile</h1>

        <h3 class="edit-header">Edit Account Information</h3>
        <p class="profile-prompt">Username: <?php $db_connection->getUserNameFromID($user_id)?></p>
        <p editable class="profile-info">user</p>
        <br>
        <p class="profile-prompt">Password:</p>
        <p editable class="profile-info">pass</p>

<!--        <h3 class="edit-header">Contact Information</h3>-->
<!--        <p class="profile-prompt">Phone Number:</p>-->
<!--        <p editable class="profile-info">pn</p>-->
<!--        <br>-->
<!--        <p class="profile-prompt">Facebook:</p>-->
<!--        <p editable class="profile-info">fb</p>-->
    </div>

    <div id="posts">
        <h1 class="content-header">Your Posts</h1>

        <h3 class="edit-header">Your Books</h3>


        <?php

        var_dump(file_get_contents('includes/php/serverside_user_post.php'));


        ?>

<!--        <table>-->
<!--            <tr>-->
<!--                <th>ISBN</th>-->
<!--                <th>Title</th>-->
<!--                <th>Edition</th>-->
<!--                <th>Author</th>-->
<!--                <th>Class</th>-->
<!--                <th>Price</th>-->
<!--                <th>Condition</th>-->
<!--                <th>Comments</th>-->
<!--                <th>Contact</th>-->
<!---->
<!---->
<!---->
<!--<!--                post_id int not null auto_increment,-->-->
<!--<!--                user_id int not null,-->-->
<!--<!--                isbn_id int not null,-->-->
<!--<!--                title varchar(1000) null,-->-->
<!--<!--                class varchar(1000) null,-->-->
<!--<!--                author varchar(1000) null,-->-->
<!--<!--                edition varchar(1000) null,-->-->
<!--<!--                item_condition varchar(1000) null,-->-->
<!--<!--                price int null,-->-->
<!--<!--                comments text null,-->-->
<!--<!--                contact varchar(3000) null,-->-->
<!---->
<!---->
<!---->
<!--            </tr>-->
<!--            <tr>-->
<!--<!--                run data tables here for post-->-->
<!--                <td class="isbn">1-1234-456</td>-->
<!--                <td class="price">$100</td>-->
<!--                <td class="pictures">pics</td>-->
<!--                <td class="condition">Brand New</td>-->
<!--                <td class="comments">No scratches</td>-->
<!--                <td class="contact">FB Me</td>-->
<!--                <td>-->
<!--                    <a editor href="#" class="btn-edit">Click to Edit</a>-->
<!--                </td>-->
<!--                <td>-->
<!--                    <a href="#" class="btn-sold">Mark as Sold</a>-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td class="isbn">234-2536</td>-->
<!--                <td class="price">$40</td>-->
<!--                <td class="pictures">pics</td>-->
<!--                <td class="condition">Acceptable</td>-->
<!--                <td class="comments">Some wear and tear on bind</td>-->
<!--                <td class="contact">Text Me</td>-->
<!--                <td>-->
<!--                    <a editor href="#" class="btn-edit">Click to Edit</a>-->
<!--                </td>-->
<!--                <td>-->
<!--                    <a href="#" class="btn-sold">Mark as Sold</a>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
        <a href="#">
            <button type="button" class="btn btn-primary" id="btn-sell">
                Sell Another Book
            </button>
        </a>

        <div id="post-edit">
            <h3 class="edit-header">Editor</h3>
            <p post-editor id="edit-isbn">isbn</p>
            <p post-editor id="edit-price">price</p>
            <p post-editor id="edit-pictures">pics</p>
            <p post-editor id="edit-condition">condition</p>
            <p post-editor id="edit-comments"></p>
            <p post-editor id="edit-contact"></p>
            <button type="button" class="btn btn-primary" id="post-save">
                Save
            </button>
        </div>
    </div>

</div>

</body>
</html>



<?php

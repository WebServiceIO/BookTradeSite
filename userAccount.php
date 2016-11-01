<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange: ISBN</title> <!-- PHP -->
    <meta name="description" content="The solution for buying and selling textbooks.">

    <!--- Bootstrap CDN -->
    <link rel = "stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!--   <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="includes/css/account.css">

    <!-- JavaScript -->
    <script type="text/javascript" src="includes/js/account.js"></script>





    <link rel = "stylesheet" href = "http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script src = "http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="includes/js/data_tables.js"></script>
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
<!--        <p class="profile-prompt">Username: --><?php //$db_connection->getUserNameFromID($user_id)?><!--</p>-->
        <p editable class="profile-info">user</p>
        <br>
        <p class="profile-prompt">Password:</p>
        <p editable class="profile-info">pass</p>


    </div>

    <div id="posts">
        <h1 class="content-header">Your Posts</h1>

        <h3 class="edit-header">Your Books</h3>


        <table id="initial_datatable" class="display" cellspacing="0" width="100%">
        </table>










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

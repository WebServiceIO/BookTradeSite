<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange: ISBN</title> <!-- PHP -->
    <meta name="description" content="The solution for buying and selling textbooks.">
    <script src = "includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src = "includes/js/bootstrap3.3.4/bootstrap.min.js"></script>
    <link rel="stylesheet" href="includes/css/account.css">
    <script type="text/javascript" src="includes/js/account.js"></script>
    <script src = "includes/js/datatables1.10.12/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="includes/js/tables/user_posts_data_tables.js"></script>
    <link rel = "stylesheet" href = "includes/css/datatables1.10.12/jquery.dataTables.min.css?v=1.0">

</head>
<body>

<?php
//require_once('includes/php/config.php');
require_once('includes/php/db_util.php');
// start a session
session_start();

//if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
//{
//    header('Location:' . site_root);
//}
//else
//{
//    $user_id = $_SESSION['USER_ID'];
$user_id = 1;
    $db_connection = new DBUtilities();
//}
?>

<!-- Navigation Bar -->
<div id="sidebar">
    <h1 id="sidebar-header">My Account</h1>
    <a href="#" class="nav-link active-link" id="profile-link">Your Profile</a>
    <a href="#" class="nav-link" id="posts-link">Posts</a>
</div>

 Start of Page Content
<div id="page-content-wrapper">
    <div id="profile">
        <h1 class="content-header">Your Profile</h1>

        <h3 class="edit-header">Edit Account Information</h3>
        <p class="profile-prompt">Username: <?php $db_connection->getUserNameFromID($user_id)?></p>
    </div>
    <div id="posts">
        <h1 class="content-header">Your Posts</h1>
        <h3 class="edit-header">Your Books</h3>
        <table id="user_post_datatable" class="display" cellspacing="0"></table>
        <a href="#">
            <button type="button" class="btn btn-primary" id="btn-sell">
            </button>
        </a>
    </div>
</div>
</body>
</html>

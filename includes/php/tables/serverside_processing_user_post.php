<?php
/*
 * Script:    DataTables server-side script for PHP and MySQL
 * Copyright: 2012 - John Becker, Beckersoft, Inc.
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
 * https://gist.github.com/jjb3rd/3156545
 */

require_once('../db_util.php');
require_once('../config/included_classes.php');

session_start();

if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
{
    header('Location: site_root');
}

else if(isset($_SESSION['USER_ID']))
{
    $user_id = $_SESSION['USER_ID'];
    $db_tools = new DBUtilities();
    $db_connection = DataBaseLoader::connect();
    $table = "posts";
    $index_column = "post_id";

    $sWhere_v1 = "WHERE user_id = " . $user_id;
    $sWhere_v2 = " AND WHERE user_id = " . $user_id;

    $columns = Array('post_id', 'user_id', 'isbn_id', 'title', 'class', 'author', 'edition', 'item_condition', 'price', 'comments', 'contact');

    include_once('serverside_processing_datatables_template.php');
}


?>

<?php
require_once('../db_util.php');
require_once('../config/included_classes.php');

$db_tools = new DBUtilities();
$db_connection = DataBaseLoader::connect();
$table = "posts";
$index_column = "post_id";

// this should only include this part for the different conditions
// this should be set in book_results.php
// the isbn in search gets checked and parse and we find the isbn_id based off the isbn
// this is saved within a session and used here
// TODO find alternative to sessions
$isbn_id = $_SESSION['isbn_id'];
// get array of post ids that use this isbn
$post_id_array_str = null;

$post_id_array = $db_tools->getAllPostIdFromIsbnId($isbn_id);

//
//if(empty($post_id_array) || $post_id_array = null)
//{
//    $post_id_array_str = null;
//}
//else
//{
    $post_id_array_str = "( ";
    foreach ($post_id_array as &$value) {
        $post_id_array_str .= $value . ", ";
    }

    $post_id_array_str = rtrim($post_id_array_str, ", ");
    $post_id_array_str .= ')';
//}



$columns = Array('post_id', 'user_id', 'title',  'author', 'edition', 'class', 'price', 'contact', 'comments');
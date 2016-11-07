<?php
require_once('../db_util.php');
require_once('../config/included_classes.php');

$db_tools = new DBUtilities();
$db_connection = DataBaseLoader::connect();
$table = "posts";
$index_column = "post_id";
$columns = Array('post_id', 'user_id', 'isbn_id title',  'author', 'edition', 'class', 'item_condition', 'price', 'contact', 'comments');


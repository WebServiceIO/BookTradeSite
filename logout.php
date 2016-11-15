<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
require_once('includes/php/db_util.php');
require_once('includes/php/session.php');
require_once('includes/php/config/config.php');

session_start();

if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
{
    $user_id = $_SESSION['USER_ID'];
    $db = new DBUtilities();
    $db->deleteSession($user_id);
    session_destroy();
}
else
{
    header('Location:' . site_root);
}


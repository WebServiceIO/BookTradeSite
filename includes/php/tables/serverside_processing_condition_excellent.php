<?php
/*
 * Script:    DataTables server-side script for PHP and MySQL
 * Copyright: 2012 - John Becker, Beckersoft, Inc.
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
 * https://gist.github.com/jjb3rd/3156545
 */


session_start();

// this should even reach this point, since this is already taken care of before getting
// to this page but it is always good practice to be safer rather than sorry
//if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
//{
//    header('Location: site_root');
//}

//else if(isset($_SESSION['USER_ID']))
//{
//
include_once('serverside_processing_datatables_initial_template.php');

$sWhere_v1 = "WHERE item_condition = 'Excellent'";
$sWhere_v2 = " AND WHERE item_condition = 'Excellent'";

include_once('serverside_processing_datatables_template.php');




//}


?>

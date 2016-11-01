<?php
/*
 * Script:    DataTables server-side script for PHP and MySQL
 * Copyright: 2012 - John Becker, Beckersoft, Inc.
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
 * https://gist.github.com/jjb3rd/3156545
 */

    require_once ('MySqlTools.php');

    $db_connection = new MySqlTools();

    $selected_table = 'posts';
    $index = 'post_id';

    echo json_encode($db_connection->getTableColumns($selected_table, 1 ));

//


?>

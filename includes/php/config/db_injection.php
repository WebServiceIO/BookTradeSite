<?php
require_once 'config.php';

// *****************DEBUGGG



$user = "";
$x = "";

$handle = fopen("/var/admin/admin", "r");

if ($handle)
{
    //while (($line = fgets($handle)) !== false) {
    if(($cur = fgets($handle)) !== false)
    {
        $user = $cur;
    }
    else
        echo 'ERROR READING FILE';

    if(($cur = fgets($handle)) !== false)
    {
        $x = $cur;
    }
    else
        echo 'ERROR READING FILE';

    fclose($handle);
} else {
    echo 'ERROR OPENING FILE';
}


echo 'USER DEBUG' . $user;
echo 'DEBUG' . $x;



// *****************DEBUGGG



class DataBaseLoader
{

    protected $db_connection;




    static function connect() {

        $db_connection = null;


        try {
            $db_connection = new PDO('mysql:dbname=' . db . ';host=' . db_host, db_login, db_pass);
            // set the PDO error mode to exception
            $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }


        return $db_connection;
    }
}
?>

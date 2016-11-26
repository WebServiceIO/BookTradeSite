<?php
require_once 'config.php';

class DataBaseLoader
{
    protected $db_connection;

    static function connect() {

        $db_connection = null;

        $user = "";
        $pass = "";
        $db = "";
        $host = "";

        try {

            $handle = fopen("/var/admin/admin", "r");

            if ($handle)
            {
                //while (($line = fgets($handle)) !== false) {
                if(($cur = fgets($handle)) !== false)
                {
                    $user = $cur;
                }
                else
                    echo 'Error has occurred, please report to admin';

                if(($cur = fgets($handle)) !== false)
                {
                    $x = $cur;
                }
                else
                    echo 'Error has occurred, please report to admin';

                if(($cur = fgets($handle)) !== false)
                {
                    $db = $cur;
                }
                else
                    echo 'Error has occurred, please report to admin';

                if(($cur = fgets($handle)) !== false)
                {
                    $host = $cur;
                }
                else
                    echo 'Error has occurred, please report to admin';

                fclose($handle);
            } else {
                echo 'Critical error has occurred, please report to admin';
            }

                $db_connection = new PDO('mysql:dbname=' . $db . ';host=' . $host, $user, $pass);
                // set the PDO error mode to exception
                $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connected successfully";
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }


return $db_connection;
    }
}
?>

<?php

require_once ("php/db_util.php");
//require_once ("../register.php");

use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    public function testCaseInsensitivity() {
        $db = new DBUtilities();
        $username = "testUsername";
        $password = "testPassword";
        $email = strtoupper("tEsTeMaIlcPp.EdU");
        $fname = "testFname";
        $lname = "testlName";

        $servername = "127.0.0.1";
        $dbname = "bookexchange";
        $dbusername = "Admin";
        $dbpassword = "12345";


        $command = "INSERT INTO users (username,password, email, fname, lname) VALUES ('$username','$password', '$email', '$fname', '$lname')";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // use exec() because no results are returned
            $conn->exec($command);
            echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo $command . "<br>" . $e->getMessage();
        }

        self::assertTrue($db->checkEmail('testemail@cpp.edu'));

        $conn = null;


    }

}
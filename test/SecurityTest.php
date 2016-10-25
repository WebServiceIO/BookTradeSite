<?php
use PHPUnit\Framework\TestCase;

require_once('../includes/php/Security.php');
require_once ('../includes/php/db_helper.php');

class SecurityTest extends TestCase
{

    public function testMeaningfulTestFunctionName() {
        // arbitrary unit test
        $a = -1;
        $this->assertEquals(-1, $a);
    }




    public function checkIfHashCanBeCompared()
    {
        $password = 'thisisatest!@#$%^&*(';
        $security_test = new Security();
        $hashed_password = $security_test->hash_password($password);
        $db = new MySqlTools();
        $this->assertTrue(password_verify($hashed_password, $password));
    }

}
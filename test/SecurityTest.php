<?php
use PHPUnit\Framework\TestCase;

require "php/security.php";
require "php/MySqlTools.php";

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
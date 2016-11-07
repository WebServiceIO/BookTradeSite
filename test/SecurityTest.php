<?php
//include_once ('../vendor/autoload.php');
//use PHPUnit\Framework\TestCase;

require "php/web_security.php";
require "php/db_util.php";

class SecurityTest extends PHPUnit_Framework_TestCase
{

    public function testMeaningfulTestFunctionName() {
        // arbitrary unit test
        $a = -1;
        $this->assertEquals(-1, $a);
    }

    public function checkIfHashCanBeCompared()
    {
        $password = 'thisisatest!';
        $security_test = new Security();
        $hashed_password = $security_test->hash_password($password);
        $this->assertTrue(password_verify($hashed_password, $password));
    }

}
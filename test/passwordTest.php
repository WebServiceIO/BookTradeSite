<?php

class LoginTest extends \PHPUnit_Framework_TestCase{
  public function testLogin(){
    try{
      $db = new PDO('mysql:dbname=' . "bookexchange" . ';host=' . "127.0.0.1", "Admin", "012345");

      $email = "gdhern4282@gmail.com";
      $pass = "0123456";

      $statement = $db->prepare("SELECT * FROM users WHERE email = '$email'");
      $statement->execute();

      $result = $statement->fetch(PDO::FETCH_ASSOC);

      $this->assertEquals(password_verify($pass, $result['password']),True);
    }catch(PDOException $s){

    }
  }
}
?>

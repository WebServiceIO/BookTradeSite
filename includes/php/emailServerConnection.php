<?php
//require_once '.../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
require_once '..\..\vendor\swiftmailer\swiftmailer\lib\swift_required.php';
class emailServerConnection{

    private $servername = 'ssl://smtp.gmail.com';
    private $username = 'bkxchnge@gmail.com';
    private $password = 'cdgt1234';
    private $port = 465;

    static function connectToEmail(){
        global $servername,$username,$password,$port;
        $connection = Swift_SmtpTransport::newInstance($servername,$port)
        ->setUsername($username)
        ->setPassword($password);
        return $connection;
    }
}
?>

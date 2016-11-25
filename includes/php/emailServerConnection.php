<?php
//require_once '../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class emailServerConnection{

    static function connectToEmail(){
        $servername = 'ssl://smtp.gmail.com';
        $username = 'bkxchnge@gmail.com';
        $password = 'cdgt1234';
        $port = 465;
        //$port = 587;
        //$port = 80;
        $connection = Swift_SmtpTransport::newInstance($servername,$port)
        ->setUsername($username)
        ->setPassword($password);
        return $connection;
    }
}
?>

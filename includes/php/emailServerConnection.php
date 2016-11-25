<?php
//require_once '../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class emailServerConnection{

    static function connectToEmail(){
        //$servername = 'ssl://gmail-smtp-msa.l.google.com';
        //$servername ='173.194.65.108';
       // $servername = 'ssl://smtp.gmail.com';
        $servername = gethostbyname("smtp.gmail.com");
        $username = 'bkxchnge@gmail.com';
        $password = 'cdgt1234';
        //$port = 25;
        $port = 587;
        //$port = 465;


        $connection = Swift_SmtpTransport::newInstance($servername, $port, "ssl")
            ->setUsername($username)
            ->setPassword($password)
            ->setSourceIp('0.0.0.0');



//        $connection = Swift_SmtpTransport::newInstance($servername, $port)
//            ->setUsername($username)
//            ->setPassword($password);


//        $connection = Swift_SmtpTransport::newInstance($servername, $port)
//            ->setUsername($username)
//        ->
//            ->setPassword($password)
//            ->setEncryption('ssl');


//        $connection = Swift_SmtpTransport::newInstance()
//            ->setHost($servername)
//            ->setPort($port)
//                ->setu($username)
//            ->setPassword($password)
//            ->setEncryption('ssl');


        return $connection;
    }
}
?>

<?php
    require_once './includes/php/emailServerConnection.php';
    // require_once './php/DataBaseLoader.php';
    require_once './includes/php/config/db_injection.php';

  //  $dbconnection = DataBaseLoader::connect();
    $emailconnection = emailServerConnection::connectToEmail();

    sendEmail();
    function sendEmail(){
      //global $emailconnection;
      $emailconnection = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465 )
          ->setUsername('bkxchnge@gmail.com')
      $message = Swift_Message::newInstance('Html')
      ->setFrom(array('bkxchnge@gmail.com'))
      ->setTo(array('gdhern4282@gmail.com'))
      ->setBody(generate_message(),'text/html');
      // ->addPart(generateLink(),'text/html');
      // $message->addPart(generate_message(),'text/html');
      // $headers = $message->getHeaders();
      // $headers->addParameterizedHeader('Content-Type','Content-type: text/html; charset=iso-8859-1');
      // //generate_message();
      $mailer = Swift_Mailer::newInstance($emailconnection);
      $result = $mailer->send($message);

    }
    function generate_message(){
      $link = generateLink();
      $message = "Welcome to BookXChange. Please verify your account to begin buying and selling textbooks on campus.\n\n <a>$link</a>";
      return $message;
    }

    function generateLink(){
      $verificationLink = md5(uniqid(rand()));
      echo $verificationLink;
    //  tempUserDb($verificationLink);
      return $verificationLink;
    }

    function tempUserDb($verificationLink){
    //  $statement = $dbconnection->prepare("INSERT INTO")
    }

?>
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 10/30/2016
 * Time: 7:44 PM
 */

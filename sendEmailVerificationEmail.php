<?php
    require_once './includes/php/emailServerConnection.php';
    require_once './includes/php/config/db_injection.php';
    require_once './vendor/swiftmailer/swiftmailer/lib/swift_required.php';
    $emailconnection = emailServerConnection::connectToEmail();

    function sendEmail($email,$user_id){
      global $emailconnection;

      $message = Swift_Message::newInstance("HTML")
      ->setFrom(array('bkxchnge@gmail.com'))
      ->setTo(array("$email"))
      ->setBody(generate_message($user_id),'text/html');

      $mailer = Swift_Mailer::newInstance($emailconnection);
      $result = $mailer->send($message);
    }

    function generate_message($user_id){
      $link = generateLink($user_id);
      $message = "Welcome to BookXChange. Please verify your account to begin buying and selling textbooks on campus.<br /><br /> <a href='localhost/bkxc/verifiedUser.php?verificationLink=$link'>$link</a>";
      return $message;
    }

    function generateLink($user_id){
      $verificationLink = md5(uniqid(rand()));
      echo $verificationLink;
      tempUserDb($user_id, $verificationLink);
      return $verificationLink;
    }

    function tempUserDb($user_id, $verificationLink){
      $dbconnection = DataBaseLoader::connect();
      $statement = $dbconnection->prepare("INSERT INTO unverified_users(user_id, verificationLink) VALUES ('$user_id','$verificationLink')");
      $result = $statement->execute();
    }

?>

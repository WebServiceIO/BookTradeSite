<?php
    require_once './includes/php/emailServerConnection.php';
    // require_once './php/DataBaseLoader.php';
    //require_once './includes/php/config/db_injection.php';
    require_once './vendor/swiftmailer/swiftmailer/lib/swift_required.php';
  //  $dbconnection = DataBaseLoader::connect();
    $emailconnection = emailServerConnection::connectToEmail();

    sendEmail("gdhern4282@gmail.com");

    function sendEmail($email){
      global $emailconnection;

      $message = Swift_Message::newInstance("HTML")
      ->setFrom(array('bkxchnge@gmail.com'))
      ->setTo(array("$email"))
      ->setBody(generate_message(),'text/html');

      $mailer = Swift_Mailer::newInstance($emailconnection);
      $result = $mailer->send($message);
    }

    function generate_message(){
      $link = generateLink();
      $message = "Welcome to BookXChange. Please verify your account to begin buying and selling textbooks on campus.<br /><br /> <a href='localhost/bkxc/verifiedUser.php?verificationLink=$link'>$link</a>";
      return $message;
    }

    function generateLink(){
      $verificationLink = md5(uniqid(rand()));
      echo $verificationLink;
      $user_id = "01";
      $username = "Gio";
      $fname ="Giovanni";
      $lname ="Hernandez";
      $email = "gdhern4282@gmail.com";
      $password = "12345";
      $contact_info = "555-123-4567";
      tempUserDb($user_id, $username, $fname, $lname, $email, $password, $contact_info, $verificationLink);
      return $verificationLink;
    }

    function tempUserDb($user_id, $username, $fname, $lname, $email, $password, $contact_info, $verificationLink){
       $dbconnection = new PDO('mysql:dbname=' . "bookxchange" . ';host=' . "127.0.0.1", "admin1", "1234");
      $statement = $dbconnection->prepare("INSERT INTO unverified_users(user_id,username,fname,lname,email,password,contact_info, verificationLink) VALUES ('$user_id','$username','$fname','$lname','$email','$password','$contact_info','$verificationLink')");
      $result = $statement->execute();
    }

?>

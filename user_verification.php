<?php
    require_once './includes/php/emailServerConnection.php';
    require_once './includes/php/config/db_injection.php';
    require_once './vendor/swiftmailer/swiftmailer/lib/swift_required.php';
    require_once './includes/php/db_util.php';
    $emailconnection = emailServerConnection::connectToEmail();

    function sendEmail($email,$user_id){
        global $emailconnection;

        $db_connection = new DBUtilities();

        $link = generateLink();

        $message = Swift_Message::newInstance("HTML")
        ->setFrom(array('bkxchnge@gmail.com'))
        ->setTo(array("$email"))
        ->setBody(generate_message($link),'text/html');

        $mailer = Swift_Mailer::newInstance($emailconnection);
        $mailer->send($message);

        $db_connection->addUserVerification($user_id, $link);
    }

    function generate_message($link){
        //$url =  htmlspecialchars($_SERVER['HTTP_HOST']);
        //$url = "https://wwww.collegexchange.info";
        $url = "http://127.0.0.1:8081/BookTradeSite";
//        $message = "<p>Welcome to BookXChange. Please verify your account to begin buying and selling textbooks on campus.</p>
//        <br />
//        <a href = '$url/login.php?verification_link=$link'>Click here to activate!</a>
//        <br />
//        <p>If link does not work, copy and paste this into the url
//        <br />
//        $url/login.php?verification_link=$link
//        </p>";

        $message = "<p>Welcome to BookXChange. Please verify your account to begin buying and selling textbooks on campus.</p>
        <br />
        <a href = '$url/login.php?verification_link=$link'>Click here to activate!</a>
        <br />
        <p>If link does not work, copy and paste this into the url
        <br />
        $url/login.php?verification_link=$link
        </p>";

      return $message;
    }

    function generateLink(){
      $verificationLink = md5(uniqid(rand()));
      return $verificationLink;
    }

?>

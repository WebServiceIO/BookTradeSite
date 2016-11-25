<?php
    require_once './includes/php/emailServerConnection.php';
    require_once './includes/php/config/db_injection.php';
    require_once './vendor/swiftmailer/swiftmailer/lib/swift_required.php';
    require_once './includes/php/db_util.php';
   // $emailconnection = emailServerConnection::connectToEmail();

    function sendEmail($email,$user_id){
        //global $emailconnection;



        $db_connection = new DBUtilities();

        $link = generateLink();

        try {

            $emailconnection = emailServerConnection::connectToEmail();

            $mailer = Swift_Mailer::newInstance($emailconnection);

//            $message = Swift_Message::newInstance("HTML")
//                ->setFrom(array('bkxchnge@gmail.com'))
//                ->setTo(array("$email"))
//                ->setBody(generate_message($link),'text/html');

            $message = Swift_Message::newInstance("BookXchange user activation")
                ->setFrom(array('bkxchnge@gmail.com' => 'BookXchange'))
                ->setTo(array($email))
                ->setBody(generate_message($link),'text/html');



           // $mailer->send($message);

            $errors = "";

            if ($recipients = $mailer->send($message, $errors))
            {
                echo 'Message successfully sent!';
            } else {
                echo "There was an error:\n";
                print_r($errors);
            }
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage(), $e->getTraceAsString());
        }

        $db_connection->addUserVerification($user_id, $link);
    }

    function generate_message($link){
        //$url =  htmlspecialchars($_SERVER['HTTP_HOST']);
        $url = "https://wwww.collegexchange.info";
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

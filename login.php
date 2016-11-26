<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange | Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/includes/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/includes/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/includes/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/includes/images/favicons/manifest.json">
    <link rel="shortcut icon" href="/includes/images/favicons/favicon.ico">
    <meta name="msapplication-config" content="/includes/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Meta Tags -->
    <meta name="author" content="Christine Nguyen Tanner Summers Giovanni Hernandez David Ghermezi">
    <meta name="description" content="The solution for buying and selling textbooks.">
    <meta name="keywords" content="bookxchange christine nguyen tanner summers giovanni hernandez david ghermezi">
    <!-- CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/login.css">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>

<div id="wrapper-content">
    <div class="container">
        <img src="includes/images/Logo-(Small)-(White).png" class="img-fluid" alt="Logo">

        <h1>Sign in to bookxchange</h1>

        <?php
        ini_set('session.cache_limiter','public');
        session_cache_limiter(false);
        include_once ('includes/php/config/config.php');
        session_start();

        if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
        {
            header('Location:' . site_root);
            die();
        }

        require_once('includes/php/web_security.php');
        require_once('includes/php/db_util.php');
        require_once('includes/php/session.php');
        require_once './includes/php/config/db_injection.php';

        $db = new DBUtilities();

//        if (isset($_GET['verification_link']) && !empty($_GET['verification_link']))
//        {
//            $db->activateAccount($_GET['verification_link']);
//        }

        $email = null;
        $pass = null;

        $conditions = Array('email' => false, 'password' => false);

        ?>

        <form id="login_form" name="login" action =" <?php htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method = "post" onsubmit = "return validateForm()">
            <div class = "form-group">
                <?php
                if(isset($_POST['email']))
                {
                    if(empty($_POST['email']))
                    {
                        echo '<h3> Please enter your email </h3>';
                    }
                    else
                    {
                        $email = trim($_POST['email']);

                        if (!$db->checkEmail($email))
                        {
                            echo '<h3> Email not valid </h3>';
                        }
                        else
                        {
                            $conditions['email'] = true;
                        }
                    }
                }
                ?>

                <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Email" value = "<?php if(isset($_POST['email'])) { echo $_POST['email']; }?>">
            </div>
            <div class="form-group">
                <?php
                if(isset($_POST['password']))
                {
                    if(empty($_POST['password']))
                    {
                        echo '<h3> Please enter a password </h3>';
                    }
                    else
                    {
                        $password = $_POST['password'];
                        if (!$db->verifyPassword($email, $password))
                        {
                            echo '<h3> Password not valid </h3>';
                        }
                        else
                        {
                            $conditions['password'] = true;
                        }
                    }
                } ?>
                <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default btn-transparent">Sign in</button>
        </form>

        <div class="row other-links">
            <div class="col-xs-18 col-md-6">
                <a href="index.php">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                    Go back to homepage
                </a>
            </div>
            <div class="col-xs-18 col-md-6">
                <a href="register.php">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    Create an account here
                </a>
            </div>
        </div>

        <?php
        header('Cache-Control: no-cache, no-store, must-revalidate');
        $session = new Session();

        if (isset($_POST['password']) && isset($_POST['email']))
        {
            // if password and email are both submitted
            if ($_POST['password'] && $_POST['email'])
            {
                if ($conditions['password'] && $conditions['email'])
                {
                    $user_id = $db->getUserIdFromEmail($email);

//                    if($db->checkValidUser($user_id) == 1)
//                    {
                        $session_arr = $session->createSessionEntry($user_id);
                        $db->insertSession($session_arr);
                        $finger_print = $db->getFingerprintInfoFromId($user_id);

                        $_SESSION['USER_ID'] = $user_id;
                        $_SESSION['FINGER_PRINT'] = $finger_print;

                        header('Cache-Control: no-cache, no-store, must-revalidate');
                        header('Location:' . site_root);
                        die();
//                    }
//                    else
//                    {
//                        echo '<h3 style="background-color:red;"> Please activate your account </h3>';
//                    }


                }
            }
        }

        ?>

    </div>
</div>

</body>
</html>

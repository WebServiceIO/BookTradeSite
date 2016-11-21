<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        session_start();

        if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
        {
            header('Location:' . site_root);
            die();
        }

        require_once('includes/php/web_security.php');
        require_once('includes/php/db_util.php');
        require_once('includes/php/session.php');
        require_once('includes/php/config/config.php');


        $db = new DBUtilities();

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
                        echo '<h3 style="background-color:red;"> Please enter your email </h3>';
                    }
                    else
                    {
                        $email = trim($_POST['email']);

                        if (!$db->checkEmail($email))
                        {
                            echo '<h3 style="background-color:red;"> Email not valid </h3>';
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
                        echo '<h3 style="background-color:red;"> Please enter a password </h3>';
                    }
                    else
                    {
                        $password = $_POST['password'];

                        if (!$db->verifyPassword($email, $password))
                        {
                            echo '<h3 style="background-color:red;"> Password not valid </h3>';
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
                    $session_arr = $session->createSessionEntry($user_id);
                    $db->insertSession($session_arr);
                    $finger_print = $db->getFingerprintInfoFromId($user_id);

                    $_SESSION['USER_ID'] = $user_id;
                    $_SESSION['FINGER_PRINT'] = $finger_print;

                    header('Cache-Control: no-cache, no-store, must-revalidate');
                    header('Location:' . site_root);
                    die();
                }
            }
        }

        ?>

    </div>
</div>

</body>
</html>

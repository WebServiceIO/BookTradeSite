<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange | Register</title>
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
    <!--[if lt IE 9]>
    <script  src="includes/js/html5shiv.js"></script>
    <![endif]-->
    <!-- CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/register.css">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="includes/js/registration.js"></script>
</head>
<body>

<div id="wrapper-content">
    <div class="container">
        <img src="includes/images/Logo-(Small)-(White).png" class="img-fluid" alt="Logo">

        <h1>Create your account</h1>

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
        require_once('includes/php/config/config.php');
        require_once ('includes/php/validation/validation.php');
        require_once('user_verification.php');

        $validation = new Validation();
        $db = new DBUtilities();

        $conditions = Array('fname' => false, 'lname' => false, 'password' => false, 'password_compare' => false, 'email' => false, 'username' => false, 'contact_info' => false);

        ?>
        <form id="reg_form" name="registration" action="<?php htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method = "post"  onsubmit="return validateForm()">
            <div class="form-group">
                <?php
                if(isset($_POST['first_name']))
                {
                    if(empty($_POST['first_name']))
                    {
                        echo '<h3> Please enter your first name </h3>';
                    }
                    else
                    {
                        $result = $validation->name_validate($_POST['first_name']);

                        if(!$result['CONDITION'])
                        {
                            echo '<h3>' . $result['ERROR'] . '</h3>';
                        }
                        else
                            $conditions['fname'] = true;
                    }
                }
                ?>
                <input type="text" class="form-control" id="fname" name = "first_name" aria-describedby="firstName" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) {echo $_POST['first_name']; }?>">
            </div>
            <div class="form-group">
                <?php
                if(isset($_POST['last_name']))
                {
                    if(empty($_POST['last_name']))
                    {
                        echo '<h3> Please enter your last name </h3>';
                    }
                    else
                    {
                        $result = $validation->name_validate($_POST['last_name']);

                        if(!$result['CONDITION'])
                        {
                            echo '<h3>' . $result['ERROR'] . '</h3>';
                        }
                        else
                            $conditions['lname'] = true;
                    }
                }
                ?>
                <input type="text" class="form-control" id="lname" name = "last_name" aria-describedby="lastName" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name']; }  ?>">
            </div>
            <div class="form-group">
                <?php
                if(isset($_POST['email']))
                {
                    if (empty($_POST['email']))
                    {
                        echo '<h3> Please enter your email </h3>';
                    }
                    else
                    {
                        if ($db->checkEmail($_POST['email']))
                        {
                            echo '<h3> Email already exists </h3>';
                        }
                        else
                        {
                            $result = $validation->email_validate($_POST['email']);

                            if(!$result['CONDITION'])
                            {
                                echo '<h3>' . $result['ERROR'] . '</h3>';
                            }
                            else
                                $conditions['email'] = true;
                        }
                    }
                }
                ?>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" value="<?php if(isset($_POST['email'])) {echo $_POST['email']; } ?>">
            </div>
            <div class="form-group">
                <?php
                if(isset($_POST['username']))
                {
                    if(empty($_POST['username']))
                    {
                        echo '<h3> Please enter a username </h3>';
                    }
                    else
                    {
                        if ($db->checkUsername($_POST['username']))
                        {
                            echo '<h3> Username already exists </h3>';
                        }
                        else
                        {
                            $result = $validation->username_validate($_POST['username']);

                            if(!$result['CONDITION'])
                            {
                                echo '<h3>' . $result['ERROR'] . '</h3>';
                            }
                            else
                                $conditions['username'] = true;
                        }
                    }
                }

                ?>
                <input type="text" class="form-control" id="username" name = "username" aria-describedby="user" placeholder="Username" value="<?php if(isset($_POST['username'])) {echo $_POST['username']; } ?>">
            </div>
            <div class="form-group">
                <?php
                if(isset($_POST['contact_info']))
                {
                    if(empty($_POST['contact_info']))
                    {
                        echo '<h3> Please enter some information for users to contact you (this can be changed later). </h3>';
                    }
                    else
                        $conditions['contact_info'] = true;
                }

                ?>
                <textarea class="form-control" id="contact_info" name="contact_info" rows="3" placeholder="Contact Info"><?php if(isset($_POST['contact_info'])) {echo $_POST['contact_info']; } ?></textarea>
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
                        $result = $validation->password_validation($_POST['password']);

                        if(!$result['CONDITION'])
                        {
                            echo '<h3>' . $result['ERROR'] . '</h3>';
                        }
                        else
                            $conditions['password'] = true;
                    }
                }
                ?>
                <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
            </div>
            <div class="form-group">
                <?php
                    if(isset($_POST['password_conf']))
                    {
                        if(empty($_POST['password_conf']))
                        {
                            echo '<h3> Please enter the same password </h3>';
                        }
                        else
                        {
                            if(isset($_POST['password']))
                            {
                                if (!empty($_POST['password']))
                                {
                                    // since they should match, not password validation here since it is already taken care of
                                    if (strcmp($_POST['password'], $_POST['password_conf']) == 0)
                                    {
                                        $conditions['password_compare'] = true;
                                    }
                                    else
                                        echo '<h3> Passwords do not match </h3>';
                                }
                            }
                        }
                    }
                ?>
                <input type="password" class="form-control" id="password_conf" name = "password_conf" placeholder="Password (Again)">
            </div>
            <button type="submit" class="btn btn-default btn-transparent">Register</button>
        </form>

        <?php

        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_conf']) && !empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['contact_info']))
        {
            $condition = true;

            foreach ($conditions as &$value)
            {
                if(!$value)
                {
                    $condition = false;
                    break;
                }
            }

            if($condition)
            {
                $newUserEmail = $_POST['email'];
                $newUserFirstName = $_POST['first_name'];
                $newUserLastName = $_POST['last_name'];
                $newUserName = $_POST['username'];
                $newUserPassword = $_POST['password'];
                $newContactInfo = $_POST['contact_info'];

                if ($db->registerUser(trim($newUserName), $newUserPassword, trim($newUserFirstName), trim($newUserLastName), trim($newUserEmail), trim($newContactInfo))) {
                    header('Location:' . login);
                    die();
                }
            }
        }


        ?>

        <div class="row other-links">
            <div class="col-xs-18 col-md-6">
                <a href="index.php">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                    Go back to homepage
                </a>
            </div>
            <div class="col-xs-18 col-md-6">
                <a href="login.php">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    Login to your account here
                </a>
            </div>
        </div>

    </div>
</div>

</body>
</html>

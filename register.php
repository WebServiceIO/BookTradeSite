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
        <img src="includes/images/Logo.png" class="img-fluid" alt="Logo">

        <h1>Create your account</h1>

        <?php

        require_once('includes/php/web_security.php');
        require_once('includes/php/db_util.php');
        require_once('includes/php/config/config.php');

        session_start();

        if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
        {
            header('Location:' . site_root);
        }
        else
        {
            if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_conf']) && !empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {

                $db = new DBUtilities();

                $newUserEmail = trim($_POST['email']);
                $newUserFirstName = trim($_POST['first_name']);
                $newUserLastName = trim($_POST['last_name']);
                $newUserName = trim($_POST['username']);
                $newUserPassword = trim($_POST['password']);

                if (strcmp($_POST['password'], $_POST['password_conf']) == 0) {
                    // if registration failed
                    if (!$db->registerUser(trim($newUserName), $newUserPassword, trim($newUserFirstName), trim($newUserLastName), trim($newUserEmail))) {
                        //header('Location: ' . htmlspecialchars($_SERVER["REQUEST_URI"]));
                        // header('Error: 34333');
                        echo '<h3 style="background-color:red;"> Please enter your first namer </h3>';
                    } else
                        header('Location:' . login);
                }
            }
        }
?>
        <?php if(isset($_POST['password']) && isset($_POST['password_conf'])) { if (strcmp($_POST['password'], $_POST['password_conf']) != 0) { echo '<h3 style="background-color:red;"> Passwords do not match </h3>'; } } ?>
        <form id="reg_form" name="registration" action="<?php htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method = "post"  onsubmit="return validateForm()">
            <div class="form-group">
                <?php if(isset($_POST['first_name'])) { if(empty($_POST['first_name'])) { echo '<h3 style="background-color:red;"> Please enter your first namer </h3>'; } } ?>
                <input type="text" class="form-control" id="fname" name = "first_name" aria-describedby="firstName" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) ?>">
            </div>
            <div class="form-group">
                <?php if(isset($_POST['last_name'])) { if(empty($_POST['last_name'])) { echo '<h3 style="background-color:red;"> Please enter your last name </h3>'; } } ?>
                <input type="text" class="form-control" id="lname" name = "last_name" aria-describedby="lastName" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])) ?>">
            </div>
            <div class="form-group">
                <?php
                if(isset($_POST['email']))
                {
                    if (empty($_POST['email']))
                    {
                        echo '<h3 style="background-color:red;"> Please enter your email </h3>';
                    }
                    else
                    {
                        //$db = new DBUtilities();
                        if ($db->checkEmail($_POST['email']))
                        {
                            echo '<h3 style="background-color:red;"> Email already exist </h3>';
                        }
                    }
                }

                ?>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" value="<?php if(isset($_POST['email'])) ?>">
            </div>
            <div class="form-group">
                <?php
                if(isset($_POST['username']))
                {
                    if(empty($_POST['username']))
                    {
                        echo '<h3 style="background-color:red;"> Please enter a username </h3>';
                    }
                    else {
                        //$db = new DBUtilities();
                        if ($db->checkUsername($_POST['username'])) {
                            echo '<h3 style="background-color:red;"> Username already exist </h3>';
                        }
                    }
                }

                ?>
                <input type="text" class="form-control" id="username" name = "username" aria-describedby="user" placeholder="Username" value="<?php if(isset($_POST['username'])) ?>">
            </div>
            <div class="form-group">
                <?php if(isset($_POST['password'])) { if(empty($_POST['password'])) { echo '<h3 style="background-color:red;"> Please enter a password </h3>'; } } ?>
                <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
            </div>
            <div class="form-group">
                <?php if(isset($_POST['password_conf'])) { if(empty($_POST['password_conf'])) { echo '<h3 style="background-color:red;"> Please enter the same password </h3>'; } } ?>
                <input type="password" class="form-control" id="password_conf" name = "password_conf" placeholder="Password (Again)">
            </div>
            <button type="submit" class="btn btn-default btn-transparent">Register</button>
        </form>



    </div>
</div>
</body>
</html>

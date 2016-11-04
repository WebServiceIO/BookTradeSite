<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange</title>
    <meta name="description" content="The solution for buying and selling textbooks.">

    <!--- JS -->
    <script src = "includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src = "includes/js/bootstrap3.3.4/bootstrap.min.js"></script>
    <script src="includes/js/registration.js"></script>

    <!--[if lt IE 9]>
    <script  src="includes/js/html5shiv.js"></script>
    <![endif]-->

    <!-- CSS -->
    <link rel = "stylesheet" href = "includes/css/bootstrap3.3.4/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/login.css">
</head>
<body>

<div class="container wrapper center">
    <h1>Register</h1>

    <?php

    require_once('includes/php/security.php');
    require_once('includes/php/db_util.php');
    require_once ('includes/php/config.php');


    session_start();
    if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
    {
        header('Location: site_root');
    }

    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_conf'])  && !empty($_POST['username'])  && !empty($_POST['first_name']) && !empty($_POST['last_name']))
    {
        $db = new DBUtilities();
        // TODO hash first then check?
        if(strcmp ($_POST['password'] , $_POST['password_conf']) != 0)
        {
            echo ' <h4> Passwords do not match </h4>';
            generateForm();
        }
        else if ($db->checkUsername($_POST['username'])) {
            // sends a raw http header
            // in this case, header field is location and value is root of the web page
            // https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
            // https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
            // http://stackoverflow.com/questions/24039340/why-is-the-http-location-header-only-set-for-post-requests-201-created-respons
            // it will redirect you to this page with error code via GET
            // http://stackoverflow.com/questions/5826784/how-do-i-make-a-php-form-that-submits-to-self
            //header('Location: '. htmlspecialchars($_SERVER["PHP_SELF"]));
            echo ' <h4> Username Already Taken </h4>';
            generateForm();
        } // check if email is taken
        else if ($db->checkEmail($_POST['email'])) {
           // header('Location: ' . htmlspecialchars($_SERVER["PHP_SELF"]));
            // header('Error: 34333');
            //headers_sent();
            //   exit("Email already taken");
            echo ' <h4> Email Already Taken </h4>';
            generateForm();

        } else {
            // Use information taken through from the current page after user submitted information
            $newUserEmail = trim($_POST['email']);
            $newUserFirstName = trim($_POST['first_name']);
            $newUserLastName = trim($_POST['last_name']);
            $newUserName = trim($_POST['username']);
            $newUserPassword = trim($_POST['password']);

            $db->registerUser($newUserName, $newUserPassword, $newUserFirstName, $newUserLastName, $newUserEmail);

           header('Location: site_root');
        }
    }
    else
    {
        echo ' <h4> Please fill out all fields </h4>';
        generateForm();
    }

    ?>




</div>
</body>
</html>





<?php
function generateForm()
{
    echo '<form id="reg_form" name="registration" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method = "post"  onsubmit="return validateForm()">';
    //echo '<form id="reg_form" name="registration" method = "post">';
    echo '<div class="form-group">';

    if(isset($_POST['first_name']))
        echo '<input type="text" class="form-control" id="fname" name = "first_name" aria-describedby="firstName" placeholder="First Name" value="' . $_POST['first_name'] . '">';
    else
        echo '<input type="text" class="form-control" id="fname" name = "first_name" aria-describedby="firstName" placeholder="First Name">';

    echo '</div>';
    echo '<div class="form-group">';

    if(isset($_POST['last_name']))
        echo '<input type="text" class="form-control" id="lname" name = "last_name" aria-describedby="lastName" placeholder="Last Name" value="' . $_POST['last_name'] . '">';
    else
        echo '<input type="text" class="form-control" id="lname" name = "last_name" aria-describedby="lastName" placeholder="Last Name">';

    echo '</div>';
    echo '<div class="form-group">';

    if(isset($_POST['email']))
        echo '<input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" value="' . $_POST['email'] . '">';
    else
        echo '<input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email">';

    echo '</div>';
    echo '<div class="form-group">';

    if(isset($_POST['username']))
        echo '<input type="text" class="form-control" id="username" name = "username" aria-describedby="user" placeholder="Username" value="' . $_POST['username'] . '">';
    else
        echo '<input type="text" class="form-control" id="username" name = "username" aria-describedby="user" placeholder="Username">';

    echo '</div>';
    echo '<div class="form-group">';
    echo '<input type="password" class="form-control" id="password" name = "password" placeholder="Password">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<input type="password" class="form-control" id="password_conf" name = "password_conf" placeholder="Password (Again)">';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Register</button>';
    echo '</form>';
}


?>


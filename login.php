<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange</title>
    <meta name="description" content="The solution for buying and selling textbooks.">

    <!--- Bootstrap CDN -->
    <link rel = "stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="includes/css/login.css">
</head>
<body>

<div class="container wrapper center">

    <h1>Login</h1>

    <?php
    require_once('includes/php/security.php');
    require_once('includes/php/db_helper.php');
    $db = new db_helper();
    $session = new Session();
    generateLoginForm();

    // make sure login info is set before using
    if(isset($_POST['password']) && isset($_POST['email']))
    {
        // if password and email are both submitted
        // TODO need to make it also use email
        if ($_POST['password'] && $_POST['email'])
        {
            // place post data into variables
            $password = $_POST['password'];
            $email = trim($_POST['email']);
            // backend validation on the email and password
            if ($db->checkEmail($email) && $db->verifyPassword($email, $password))
            {
                // start a session for login
                session_start();
                // get user id;
                $user_id = $db->getUserIdFromEmail($email);
                // check if session already exist
                if(isset($_SESSION['USER_ID']))
                {
                    echo 'debug login.php 1';
                    // really, there should not already exsit the same useri d session
                    if($_SESSION['USER_ID'] == $user_id)
                    {
                        //DEBUG
                        echo 'something has gone wrong';
                    }
                }
                // no current session exist
                else
                {
                    echo 'debug login.php 2';
                    // create new session with this ID ONLY
                    $session_arr = $session->createSessionEntry($user_id);
                    // insert session int odb
                    $db->insertSession($session_arr);
                }
                // after success,
                header('Location: index.php');
                // if email is invalid
            } else if (!checkEmail($email)) {
                echo "Invalid email";
                // if passwords do not match
            } else if (!$db->verifyPassword($email, $password)) {
                echo "Incorrect password, please try again.";
            }
        } else {
            echo "Fill in credentials";
        }
    }
    ?>


</div>

</body>
</html>



<?php

function generateLoginForm(){
    echo '<form id="login_form" name="login" action ="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method = "post" onsubmit = "return validateForm()">';

    echo '<div class = "form-group">';

    if(isset($_POST['email']))
        echo '<input type = "text" class = "form-control" id = "email" name = "email" aria-decribedby = "email" placeholder = "Email" value = "'.$_POST['email'].'">';

    else
        echo '<input type  ="email" class="form-control" id = "email" name = "email" aria-describedby = "email" placeholder="Email">';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<input type="password" class="form-control" id="password" name = "password" placeholder="Password">';
    echo '</div>';

    echo '<button type="submit" class="btn btn-primary">Login</button>';
    echo '</form>';
}
?>

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
            <img src="includes/images/Logo.png" class="img-fluid" alt="Logo">

            <h1>Sign in to bookxchange</h1>

            <?php
            require_once('includes/php/web_security.php');
            require_once('includes/php/db_util.php');
            require_once('includes/php/session.php');
            require_once('includes/php/config/config.php');

            // start a session for login
            session_start();

            if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
            {
                header('Location:' . site_root);
            }

            $db = new DBUtilities();
            header('Cache-Control: no-cache, no-store, must-revalidate');
            $session = new Session();
            generateLoginForm();
            // make sure login info is set before using
            if(isset($_POST['password']) && isset($_POST['email']))
            {
                // if password and email are both submitted
                if ($_POST['password'] && $_POST['email'])
                {
                    // place post data into variables
                    $password = $_POST['password'];
                    $email = trim($_POST['email']);
                    $is_valid_email = $db->checkEmail($email);
                    $is_valid_password = $db->verifyPassword($email, $password);

                    if ($is_valid_email && $is_valid_password)
                    {

                        // get user id;
                        $user_id = $db->getUserIdFromEmail($email);
                        $finger_print = $db->getFingerprintInfoFromId($user_id);
                        // check if session already exist

                        if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
                        {
                            // check if current session is the right session
                            // may not be needed but is extra security
                            if(($_SESSION['USER_ID'] == $user_id) && ($_SESSION['FINGER_PRINT'] == $finger_print))
                            {
                                //DEBUG
                                echo 'something has gone wrong - DEBUG';
                            }
                        }
                        // no current session exist
                        else
                        {
                             //create new session with this ID ONLY
                            $session_arr = $session->createSessionEntry($user_id);
                            // insert session int odb
                            $db->insertSession($session_arr);
                        }
                        // after success,
                        header('Cache-Control: no-cache, no-store, must-revalidate');
                        header('Location:' . site_root);
                        // if email is invalid
                    } else if (!$is_valid_email) {
                        echo "Invalid email";
                        // if passwords do not match
                    } else if (!$is_valid_password) {
                        echo "Incorrect password, please try again.";
                    }
                } else {
                    echo "Fill in credentials";
                }
            }
            ?>

        </div>
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
        echo '<input type = "email" class="form-control" id = "email" name = "email" aria-describedby = "email" placeholder="Email">';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<input type="password" class="form-control" id="password" name = "password" placeholder="Password">';
    echo '</div>';

    echo '<button type="submit" class="btn btn-default btn-transparent">Sign in</button>';
    echo '</form>';
}
?>

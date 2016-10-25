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
    require_once('includes/php/Security.php');
    require_once('includes/php/MySqlTools.php');
    require_once('includes/php/Session.php');
    $db = new MySqlTools();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    $session = new Session();
    generateLoginForm();
    // start a session for login
    session_start();


    if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
    {
       header('Location: index.php');
    }
    // make sure login info is set before using
    else if(isset($_POST['password']) && isset($_POST['email']))
    {
        // if password and email are both submitted
        if ($_POST['password'] && $_POST['email'])
        {
            // place post data into variables
            $password = $_POST['password'];
            $email = strtoupper(trim($_POST['email']));
            // backend validation on the email and password
            $is_valid_email = $db->checkEmail($email);
            $is_valid_password = $db->verifyPassword($email, $password);

            if ($is_valid_email && $is_valid_password)
            {

                // get user id;
                $user_id = $db->getUserIdFromEmail($email);
                $finger_print = $db->getFingerprintInfoFromId($user_id);
                // check if session already exist
                // TODO delete soon after testing
//                if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
//                {
//                    // check if current session is the right session
//                    // may not be needed but is extra security
//                    if(($_SESSION['USER_ID'] == $user_id) && ($_SESSION['FINGER_PRINT'] == $finger_print))
//                    {
//                        //DEBUG
//                        echo 'something has gone wrong';
//                    }
//                }
//                // no current session exist
//                else
//                {
                    // create new session with this ID ONLY
                    $session_arr = $session->createSessionEntry($user_id);

                   // var_dump($session_arr);

                    // insert session int odb
                    $db->insertSession($session_arr);
                    // TODO NEED TO TAKE CARE OF ERRORS HERE FOR DB
                //}
                // after success,
                header('Cache-Control: no-cache, no-store, must-revalidate');
                header('Location: index.php');
                // if email is invalid
            } else if ($is_valid_email) {
                echo "Invalid email";
                // if passwords do not match
            } else if ($is_valid_password) {
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

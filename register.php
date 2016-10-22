<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bookxchange</title>
    <meta name="description" content="The solution for buying and selling textbooks.">

    <!--- JS -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="includes/js/registration.js"></script>

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->

    <!-- CSS -->
    <link rel = "stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/login.css">
</head>
<body>

<div class="container wrapper center">
    <h1>Register</h1>

    <?php



    // TODO make the page repopulate with post data back into fields
    require_once('includes/php/security.php');
    require_once('includes/php/db_helper.php');
    $db_connection = db_loader::connect();



    session_start();
    if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
    {
        header('Location: index.php');
    }

    /*
     * Allow the user to register to the website
     * If user registered properly, it will be redirected back to home page with a session
     * If user registration is incorrect, it will come back to this page using post
     */

    // checks for set fields, all must be filled out to continue
    // JS will check first but in case of hack, glitch, etc, this is the second line of defense



//    $post_values = array();
//    $post_values['email'] = $_POST['email'];
//    $post_values['password'] = $_POST['password'];
//    $post_values['username'] = $_POST['username'];
//    $post_values['first_name'] = $_POST['first_name'];
//    $post_values['last_name'] = $_POST['last_name'];


    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_conf'])  && !empty($_POST['username'])  && !empty($_POST['first_name']) && !empty($_POST['last_name']))
    {
        // need to check for "", this is not normal but due to other code implmentaiton, it is needed
       // if ((strcmp($_POST['email'], "") != 0) || (strcmp($_POST['password'], "") != 0) || (strcmp($_POST['password_conf'], "") != 0) ||(strcmp($_POST['username'], "") != 0) || (strcmp($_POST['first_name'], "") != 0) ||
       //(strcmp($_POST['last_name'], "") != 0)) {
            if (checkUsername($_POST['username'])) {
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
            else if (checkEmail($_POST['email'])) {
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

                registerUser($newUserName, $newUserPassword, $newUserFirstName, $newUserLastName, $newUserEmail);

               header('Location: index.php');
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

function registerUser($username, $password, $fname, $lname, $email)
{

    // check if username is taken
//    if(checkUsername($username))
//    {
//        // sends a raw http header
//        // in this case, header field is location and value is root of the web page
//        // https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
//        // https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
//        // http://stackoverflow.com/questions/24039340/why-is-the-http-location-header-only-set-for-post-requests-201-created-respons
//        // it will redirect you to this page with error code via GET
//        // http://stackoverflow.com/questions/5826784/how-do-i-make-a-php-form-that-submits-to-self
//
//        echo 'debug 1';
//
////        header('Error: 343');
////        header('Location: '. htmlspecialchars($_SERVER["PHP_SELF"]));
//        return false;
//        //
//
//    }
//    // check if email is taken
//    else if (checkEmail($email))
//    {
//        header('Location: '. htmlspecialchars($_SERVER["PHP_SELF"]));
//        // header('Error: 34333');
//        //headers_sent();
//        //   exit("Email already taken");
//        return false;
//    }
    // email and username not taken
   // else
   // {
        // generate hash of password
        $hashed_password = Security::hash_password($password);

        // TODO will need to be updated for sessions later
        $insert = $GLOBALS['db_connection']->prepare("INSERT INTO users (username, password, email, fname, lname) VALUES (:username, :hashed_password, :email, :fname, :lname)");
        // PDO::PARAM_STR (integer) : Represents the SQL CHAR, VARCHAR, or other string data type.
        $insert->bindValue(':username', $username, PDO::PARAM_STR);
        $insert->bindValue(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $insert->bindValue(':email', $email, PDO::PARAM_STR);
        $insert->bindValue(':fname', $fname, PDO::PARAM_STR);
        $insert->bindValue(':lname', $lname, PDO::PARAM_STR);
        // execute query
        $insert->execute();
        return true;

//            if($session->isLoggedIn() == false) {
//                $this->login($username, $password);
//            }

  // }

}



function checkUsername($username)
{
    $user_count =  $GLOBALS['db_connection']->query("SELECT username FROM users WHERE username = '$username'")->rowCount();
    if($user_count >= 1)
        return true;
    else
        return false;
}

function checkEmail($email)
{
    $email_count =  $GLOBALS['db_connection']->query("SELECT email FROM users WHERE email = '$email'")->rowCount();

    if($email_count>= 1)
        return true;
    else
        return false;
}


?>


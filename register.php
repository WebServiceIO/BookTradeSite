<script src ="registration.js"></script>







<?php


// TODO make the page repopulate with post data back into fields
require_once('includes/included_classes.php');
$db_connection = db_loader::connect();






/*
 * Allow the user to register to the website
 * If user registered properly, it will be redirected back to home page with a session
 * If user registration is incorrect, it will come back to this page using post
 *
 *
 */

//// TODO need to find post type requst
//// Check for error code passed via GET
//if(isset($_POST['error']))
//{
//    if ($_POST['error'] == 234) {
//        // print to screen error
//        echo '<h1> username taken </h1>';
//    } else if ($_POST['error'] == 342) {
//        // print to screen error
//        echo '<h1> email taken </h1>';
//    }
//
//    //end current script
//    exit();
//}
// checks for set fields, all must be filled out to continue
// JS will check first but in case of hack, glitch, etc, this is the second line of defense
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])  && isset($_POST['first_name']) && isset($_POST['last_name']))
{
    echo '<form name="registration" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '"  method = "post">';
    echo 'Email <input type="text" name="email" value="' . $_POST['email'] . '" required><br>';
    echo 'User Name <input type = "text" name = "username"  value="' . $_POST['username'] . '"required><br>';
    echo 'Password <input type = "text" name = "password"  value="' . $_POST['password'] . '"required><br>';
    echo 'First Name <input type = "text" name = "first_name" value="' . $_POST['first_name'] . '" required><br>';
    echo 'Last Name <input type = "text" name = "last_name"  value="' . $_POST['last_name'] . '"required><br>';
    echo '<input type = "submit">';
    echo '</form>';

    // Use information taken through from the current page after user submitted information
    $newUserEmail = trim($_POST['email']);
    $newUserFirstName = trim($_POST['first_name']);
    $newUserLastName = trim($_POST['last_name']);
    $newUserName = trim($_POST['username']);
    $newUserPassword = trim($_POST['password']);

    // run function to register user
    //header('Error: 4045');
    registerUser($newUserName, $newUserPassword, $newUserFirstName, $newUserLastName, $newUserEmail);
}
else
{
    echo '<form name="registration" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method = "post">';
    echo 'Email <input type="text" name="email" required><br>';
    echo 'User Name <input type = "text" name = "username" required><br>';
    echo 'Password <input type = "text" name = "password" required><br>';
    echo 'First Name <input type = "text" name = "first_name" required><br>';
    echo 'Last Name <input type = "text" name = "last_name" required><br>';
    echo '<input type = "submit">';
    echo '</form>';
}






//
//password
//$user = new User();
//
//
//$user->create($newUserName, $newUserPassword, $newUserFirstName, $newUserLastName, $newUserEmail);




function registerUser($username, $password, $fname, $lname, $email)
{
    // check if username is taken
    if(checkUsername($username))
    {
        // sends a raw http header
        // in this case, header field is location and value is root of the web page
        // https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
        // https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
        // http://stackoverflow.com/questions/24039340/why-is-the-http-location-header-only-set-for-post-requests-201-created-respons
        // it will redirect you to this page with error code via GET
        // http://stackoverflow.com/questions/5826784/how-do-i-make-a-php-form-that-submits-to-self
        header('Location: '. htmlspecialchars($_SERVER["PHP_SELF"]));
        header('Error: 343');
        exit("Username already taken");
    }
    // check if email is taken
    else if (checkEmail($email))
    {
        header('Location: '. 'register.php');
        exit("Email already taken");
    }
    // email and username not taken
    else
    {
        // generate hash of password
        $hashed_password = DBSecurity::hash_password($password);
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
        // once logged in, it will redirect them here
        // TODO test with sessions
       // todo REDIRECT TO LOGGED IN PAGE, OR THE MIAN PAGE
        header('Location: index.php');

//            if($session->isLoggedIn() == false) {
//                $this->login($username, $password);
//            }

    }
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
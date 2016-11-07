<?php
/*
 * Once the user has properly filled out the form required to register
 * this code will be called. It will send out an email using a free gmail
 * account that we create for the website. It will send a link that the
 * user can click on to verify their email. At this point the email will be
 * a cpp email.
 */
//Will be taken from the user registration code. Should these have set functions?
$to = $from = $subject = $message = $result = $confirmation_code = '';//message will contain the link for the user to follow; Le's us know when the user clicks

$temporary_table = 'pending_activation_db';

function call_email_validation($name,$email,$username, $password){
    global $result;
    $result = prepare_temp_insert($name,$email,$username,$password);
    if($result){
        prepare_email($email);
        sendVerifyEmail();
    }
}

function prepare_temp_insert($name, $email, $username, $password){
    global $temporary_table, $confirmation_code;
    //Generate a unique confirmation code that will be added to a
    //temporary database along with all the new user's information
    $confirmation_code = md5(uniqid(rand()));
    $query = "INSERT INTO $temporary_table(confirmation_code,name,email, username, password)
              VALUES('$confirmation_code','$name','$email','$username','$password')";
    return;//Have to make a query here
}

//Set up the message that will be sent when the user submits. It will contain
function prepare_email($email){
    global $to, $from, $subject,$message,$confirmation_code;
    $to = $email;
    $from = "From: bookxchange@gmail.com";
    $subject = "BookXChange Account Verification";
    $message = "Please follow the link in order to activate your BookXChange account. "
    ."https://www.bookxchange.com/email_confirm.php?confirmkey=".$confirmation_code;
}

function sendVerifyEmail()
{
    global $to, $subject, $message, $from;
    $success = mail($to, $subject, $message,$from);
    if ($success) {
        //code that will add the account to database?
    } else {
        //Deny the account creation
    }
}
?>
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
    <link rel="stylesheet" href="../includes/css/login.css">
</head>
<body>

<div class="container wrapper center">

    <h1>Login</h1>

    <form>
        <div class="form-group">
            <input type="email" class="form-control" id="user" aria-describedby="useremail" placeholder="Email or username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="pass" placeholder="Password">
        </div>
        <div class="form-group">
            <select class="form-control" id="school">
                <option>California Polytechnic State University, Pomona</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Log In</button>
    </form>

    <p>Not registered? <a href="register.html">Create an account!</a></p>

</div>

</body>
</html>


<?php


$newUserEmail = $_POST['email'];
$newUserFirstName = $_POST['first_name'];
$newUserLastName = $_POST['last_name'];
$newUserName = $_POST['username'];
$newUserPassword = $_POST['password'];

//
//  //Use information taken through a html form on the client side.
//  $newUserEmail = $_POST['email'];
//  $newUserFirstName = $_POST['first_name'];
//  $newUserLastName = $_POST['last_name'];
//  $newUserName = $_POST['username'];
//  $newUserPassword = $_POST['password'];
////If all the validations go through, Pass them to the database? (Tanner)
///**
// * Make sure that the email is valid. Verify a cpp domain.
// * @return string
// */
//function validateEmail(){
//    global $newUserEmail, $emailError;
//    if(!$newUserEmail){
//        $emailError = "A valid email  is required.";
//    }
//    //Use a filter to check that input matches reqs. of an e-mail address
//    if(filter_var($newUserEmail,FILTER_VALIDATE_EMAIL)) {
//        $newUserEmail = htmlspecialchars($newUserEmail);
//        //Check that the email then has a @cpp.edu domain
//        if (!strpos($newUserEmail, '@cpp.edu')) {
//            $emailError = "Not a valid CPP.edu e-mail address.";
//        }
//    }
//    else{
//        $emailError = "Not a valid CPP.edu e-mail address.";
//    }
//}
///**
// * Make sure the first and last name is only made up of letters.
// * If it contains numbers or special characters, update the $firstNameError.
// */
//function validateFirstName(){
//    global $newUserFirstName, $firstNameError;
//    if(!onlyAlphaCharacters($newUserFirstName)){
//        $firstNameError = "First name must only contain letters.";
//    };
//}
//function validateLastName(){
//    global $newUserLastName, $lastNameError;
//    if(!onlyAlphaCharacters($newUserLastName)){
//        $lastNameError = "Last name must only contain letters.";
//    }
//}
///**
// *  Make sure that the userName chosen by the new user is available
// *  by checking the database (Tanner?)
// *  Also make sure that html can be added by the user. (Is it done from here?)
// */
//function checkUserNameAvailable(){
//    global $newUserName;
//    $newUserName = formDataValidation($newUserName);
//    //call a function that will search through database to see if
//    //there already exists a matching username. If it does return an error message.
//}
///**
// * Same as the userName make sure that the password is at least 8 characters.(For now?)
// * Make sure that no html can be added by user either.
// *
// */
//function checkPassword(){
//    global $newUserPassword, $passwordError;
//    $newUserPassword = formDataValidation($newUserPassword);
//    if ($newUserPassword <= 7)
//        $passwordError = "Password must be at least 8 characters long";
//    //Call a function to add the valid and hashed password to the database.
//}
///**
// * Function to check that a string only contains letters.
// * @param $name how first and last name are checked.
// */
//function onlyAlphaCharacters($name){
//    if(!ctype_alpha($name)){
//        return false;
//    }
//    else{
//        return true;
//    }
//}
///**
// * This function is meant to help prevent the injection of client-side scripts.
// * Not sure if it should go here or not.
// * @param $formData data that will be processed to prevent attacks.
// * @return string fully processed string.
// */
//function formDataValidation($formData){
//    $formData = trim($formData);
//    $formData = stripslashes($formData);
//    $formData = htmlspecialchars($formData);
//    return $formData;
//}
//?>

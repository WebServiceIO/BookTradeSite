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

    <?php
    require_once('includes/php/included_classes.php');
    use Goutte\Client;

    generateLoginForm();
    if($_POST['password'] && $_POST['email']) {
        $password = $_POST['password'];
        $email = $_POST['email'];

        if(checkEmail($email) && verifyPassword($email, $password)) {
            header('Location: index.php');
        }
        else if(!checkEmail($email)){
            echo "Invalid email";
        }
        else if(!verifyPassword($email,$password)){
            echo "Incorrect password, please try again.";
        }
    }
    else{
        echo "Fill in credentials";
    }
    ?>


</div>

</body>
</html>



<?php
function checkEmail($email){
    try {
        $db_connection = db_loader::connect();
        $statement = $db_connection->prepare("SELECT * FROM users WHERE email = '$email'");
        $result = $statement->execute();
        return $result;
    }catch(PDOException $e){
        echo "Error in checkEmail";
    }
}
function verifyPassword($email, $password){
    try {
        $db_connection = db_loader::connect();
        $statement = $db_connection->prepare("SELECT password FROM users WHERE email = '$email'");
        $statement->execute();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        $x = $statement->fetch();
        return password_verify($password,$x['password']);
    }catch(PDOException $e){
        echo "Error in verifyPassword";
    }
}

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

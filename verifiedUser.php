<?php
    $link = $_GET['verificationLink'];
    $dbconnection = new PDO('mysql:dbname=' . "bookxchange" . ';host=' . "127.0.0.1", "admin1", "1234");
    $retrieve = $dbconnection->prepare("SELECT * FROM unverified_users WHERE verificationLink = '$link'");
    $results = $retrieve->execute();
    $x = $retrieve->fetch(PDO::FETCH_ASSOC);
    $user_id = $x['user_id'];
    echo $user_id;
    $username = $x['username'];
    $fname = $x['fname'];
    $lname = $x['lname'];
    $email = $x['email'];
    $password = $x['password'];
    $contact_info = $x['contact_info'];
    $add = $dbconnection->prepare("INSERT INTO users(user_id,username,fname,lname,email,password,contact_info) VALUES ($user_id,$username,$fname,$lname,$email,$password,$contact_info)");
    $result = $add->execute();
    $statement = $dbconnection->prepare("DELETE FROM unverified_users WHERE verificationlink = '$link'");
    $result = $statement->execute();
?>

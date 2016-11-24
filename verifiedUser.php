<?php
    $link = $_GET['verificationLink'];
    $dbconnection = new PDO('mysql:dbname=' . "bookxchange" . ';host=' . "127.0.0.1", "admin1", "1234");
    $retrieve = $dbconnection->prepare("SELECT user_id FROM unverified_users WHERE verificationLink = '$link'");
    $results = $retrieve->execute();
    $x = $retrieve->fetch();
    $user_id = $x['user_id'];
    $add = $dbconnection->prepare("UPDATE users SET valid_bit = '1' WHERE user_id = '$user_id'");
    $result = $add->execute();
    $statement = $dbconnection->prepare("DELETE FROM unverified_users WHERE verificationlink = '$link'");
    $result = $statement->execute();
?>

<?php

//Use information taken through a html form on the client side.
$newUserEmail = $_POST['email'];
$newUserFirstName = $_POST['first_name'];
$newUserLastName = $_POST['last_name'];
$newUserName = $_POST['username'];
$newUserPassword = $_POST['password'];

//$newUserEmail = $_POST['email'];
//$newUserFirstName = $_POST['first_name'];
//$newUserLastName = $_POST['last_name'];
//$newUserName = $_POST['username'];
//$newUserPassword = $_POST['password'];

require_once('includes/included_classes.php');


$user = new User();

$user->create($newUserName, $newUserPassword, $newUserFirstName, $newUserLastName, $newUserEmail);
echo 'done adding user';

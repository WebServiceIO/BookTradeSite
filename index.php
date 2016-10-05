<!DOCTYPE html>
<html lang="en">
<head>
<script src ="register.js"></script>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form name="register" action = "register.php" onsubmit="return validateForm()" method = "post">
    Email <input type="text" name="email"><br>
    User Name <input type = "text" name = "username"><br>
    Password <input type = "text" name = "password"><br>
    First Name <input type = "text" name = "first_name"><br>
    Last Name <input type = "text" name = "last_name"><br>
    <input type = "submit">
</form>
</body>

<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src ="register.js"></script>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form name="register" action = "register.php" onsubmit="return validateForm()" method = "post">
    Email <input type="text" name="email" required><br>
    User Name <input type = "text" name = "username" required><br>
    Password <input type = "text" name = "password" required><br>
    First Name <input type = "text" name = "first_name" required><br>
    Last Name <input type = "text" name = "last_name" required><br>
    <input type = "submit">
</form>
</body>

<?php
?>

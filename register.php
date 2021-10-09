<?php

require 'session.php';
require 'connection.php';

if (isset($_SESSION['userID']))
		header('Location:index.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <title>WatchIT</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <h2>Sign up</h2>
        <div class="form">
            <div class="form-inner">
                <p>Email</p>
                <input type="email" id="email" placeholder="email@example.com">
                <p>Username</p>
                <input type="text" id="username" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" id="password" placeholder="Enter Password">
                <p>Repeat Password</p>
                <input type="password" id="password-repeat" placeholder="Enter Password">
                <button id="register-button">Sign up</button>
                <p class="or">OR</p>
                <a href="login.php"><button id='other-button'>Sign in</button></a>
                <div id="response"></div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-content">

        </div>
    </div>
    <script src="js/register.js"></script>
</body>
</html>
<?php

require '../session.php';
require '../connection.php';

if (isset($_SESSION['adminID']))
	header('Location:index.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>WatchIT</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <h2>ADMIN</h2>
        <div class="form">
            <div class="form-inner">
                <p>Username</p>
                <input type="text" id="username" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" id="password" placeholder="Enter Password">
                <button id="login-button">Sign In</button>
                <div id="response"></div>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="js/login.js"></script>
</body>
</html>
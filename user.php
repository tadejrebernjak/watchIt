<?php

require 'session.php';
require 'connection.php';

if (!isset($_SESSION['userID']))
    header('Location:login.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/user.css">
    <title>YouTube</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <?php require 'searchbar.php' ?>
        <div class="inner-content">
            <div class="left">
                <div class="field">
                    <h3>Change Username</h3>
                    <input type="text" id="username-change" placeholder="Enter New Username"></input>
                    <button id="username-change-button">Confirm</button>
                </div>
                <div class="field">
                    <h3>Change Password</h3>
                    <input type="text" id="current-password" placeholder="Enter Password"></input><br>
                    <input type="text" id="new-password" placeholder="Enter New Password"></input><br>
                    <input type="text" id="new-password-repeat" placeholder="Repeat New Password"></input>
                    <button id="password-change-button">Confirm</button>
                </div>
                <div class="field">
                    <h3>Change Profile Picture</h3>
                    <input type="file">
                    <button id="pfp-change-button">Confirm</button>
                </div>
            </div>
            <div class="right">
                <div>
                    <?php 
                    if ($user['profile_picture_url'] == "") {
                        echo "<img src='media/images/default-pfp.jpg' alt='pfp'>";
                    }
                    else {
                        echo "<img src='media/images/" . $user['profile_picture_url'] . "'>";
                    }
                    echo "<h2>" . $user['username'] . "</h2>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-content">

        </div>
    </div>
    <script>
        document.getElementById("login-button").addEventListener("click", loginSubmit);
    </script>
</body>
</html>
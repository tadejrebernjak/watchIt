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
                <input type="hidden" id="user-id" value="<?php echo $_SESSION['userID'] ?>"></input>
                <div class="field">
                    <h3>Change Username</h3>
                    <input type="text" id="username-change" placeholder="Enter New Username"></input>
                    <button id="username-change-button">Confirm</button>
                    <div id="username-response"></div>
                </div>
                <div class="field">
                    <h3>Change Password</h3>
                    <p>Current Password</p>
                    <input type="password" id="current-password" placeholder="Enter Password"></input><br>
                    <p>New Password</p>
                    <input type="password" id="new-password" placeholder="Enter New Password"></input><br>
                    <input type="password" id="new-password-repeat" placeholder="Repeat New Password"></input>
                    <button id="password-change-button">Confirm</button>
                    <div id="password-response"></div>
                </div>
                <div class="field">
                    <h3>Change Profile Picture</h3>
                    <form action="update_pfp.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userID'] ?>">
                        <input type="file" name="pfp" id="pfp-file">
                        <input type="submit" value="Confirm">
                        <div id="pfp-response">
                            <?php 
                                if (isset($_GET['r'])) {
                                    if ($_GET['r'] == "pfperror") {
                                        echo "File is too large or is an invalid type";
                                    }
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="right">
                <div>
                    <?php 
                    echo "<label for='pfp-file'>";
                    if ($user['profile_picture_url'] == "") {
                        echo "<img src='media/images/default-pfp.jpg' alt='pfp'>";
                    }
                    else {
                        echo "<img src='" . $user['profile_picture_url'] . "'>";
                    }
                    echo "</label><br><label for='username-change'><h2>" . $user['username'] . "</h2></label>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-content">

        </div>
    </div>
    <script src="js/user.js"></script>
</body>
</html>
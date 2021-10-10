<?php

require '../session.php';
require '../connection.php';
include '../functions.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: login.php");
}

include 'select_admin.php';

$userID = $_GET['id'];

include 'select_user.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/channel.css">
    <title>Admin</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <h1><?php echo $user['username'] . " [" . $userID . "]"; ?></h1>
        <div class="upload-form">
            <form action="update_user.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="videoid" value="<?php echo $user['id'] ?>">
                <h3>Username</h3>
                <input type="text" name="username" placeholder="Enter username" required="required" value="<?php echo $user['username']; ?>">
                <h3>Email</h3>
                <input type="email" name="email" placeholder="Enter email" required="required" value="<?php echo $user['email']; ?>">
                <h3>Description</h3>
                <textarea name="description" id="description" cols="30" rows="5" placeholder="Channel description..."><?php
                            if (isset($user['description']) && $user['description'] != "") {
                                echo str_replace('<br />', "", $user['description']);
                            }
                        ?></textarea>
                <h3>Profile image</h3>
                <div class="pfp-preview">
                    <?php
                        if (isset($user['profile_picture_url']) && $user['profile_picture_url'] != "") {
                            echo "<img src='../" . $user['profile_picture_url'] . "' id='pfp'>";
                        }
                        else {
                            echo "<img src='../media/images/default-pfp.jpg' id='pfp'>";
                        }
                    ?>
                </div>
                <input type="file" name="pfp" id="pfp-file">
                <h3>Banner image</h3>
                <div class="banner-preview">
                    <?php
                        if (isset($user['banner_picture_url']) && $user['banner_picture_url'] != "") {
                            echo "<img src='../" . $user['banner_picture_url'] . "' id='banner'>";
                        }
                        else {
                            echo "<img src='../media/images/no-banner.jpg' id='banner'>";
                        }
                    ?>
                </div>
                <input type="file" name="banner" id="banner-file">
                <input type="submit" value="Confirm">
            </form>
            <div style="clear:both;"></div>
        </div>
        <button class="remove-button" id="remove-button">DELETE USER</button>
    </div>
    <?php include '../footer.php'; ?>
    <script src="js/channel.js"></script>
</body>
</html>
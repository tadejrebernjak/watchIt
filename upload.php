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
    <link rel="stylesheet" href="css/upload.css">
    <title>WatchIT</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <?php require 'searchbar.php' ?>
        <div class="inner-content">
            <h2>Video Upload</h2>
            <div class="upload-form">
                <form action="upload_video.php" method="post" enctype="multipart/form-data">
                    <h3>Video File</h3>
                    <input type="file" name="video" id="video-file" required="required">
                    <h3>Title</h3>
                    <input type="text" name="title" placeholder="Enter video title" required="required">
                    <h3>Description (optional)</h3>
                    <textarea name="description" id="description" cols="30" rows="5" placeholder="Video description..."></textarea>
                    <h3>Visibility</h3>
                    <select name="visibility" id="visibility">
                        <option value="1" selected="selected">Visible</option>
                        <option value="0">Hidden</option>
                    </select>
                    <h3>Thumbnail image (optional)</h3>
                    <input type="file" name="thumbnail" id="thumbnail-file" required="required">
                    <input type="submit" value="Confirm">
                </form>
                <div style="clear:both;"></div>
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
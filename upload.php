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
        <div class="inner-content">
            <h2>Video Upload</h2>
            <div class="upload-form">
                <form action="upload_video.php" method="post" enctype="multipart/form-data">
                    <h3>Video File</h3>
                    <input type="file" name="video" id="video-file" required="required">
                    <?php
                    if (isset($_GET['r'])) {
                        if ($_GET['r'] == "videoerror") {
                            echo "<p class='error-text align-left'>Invalid file type or video is too large</p>";
                        }
                    }
                    ?>
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
                    <div class="thumbnail-preview">
                        <img src='media/images/no-thumbnail.jpg' id='thumbnail'>
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail-file">
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
    <script src="js/thumbnail_preview.js"></script>
</body>
</html>
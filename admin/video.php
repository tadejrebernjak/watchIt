<?php

require '../session.php';
require '../connection.php';
include '../functions.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: login.php");
}

include 'select_admin.php';

$videoID = $_GET['id'];

include 'select_video.php';

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
        <h1><?php echo $video['title'] . " [" . $videoID . "]"; ?></h1>
        <div class="upload-form">
            <form action="update_video.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="videoid" value="<?php echo $video['id'] ?>">
                <h3>Title</h3>
                <input type="text" name="title" placeholder="Enter video title" required="required" value="<?php echo $video['title']; ?>">
                <h3>Description</h3>
                <textarea name="description" id="description" cols="30" rows="5" placeholder="Video description..."><?php
                            if (isset($video['description'])) {
                                echo str_replace('<br />', "", $video['description']);
                            }
                        ?></textarea>
                <h3>Visibility</h3>
                <select name="listed" id="listed">
                    <?php
                        if ($video['listed'] === 1) {
                            echo "<option value='1' selected='selected'>Visible</option>"
                            . "<option value='0'>Hidden</option>";
                        }
                        else {
                            echo "<option value='1'>Visible</option>"
                            . "<option value='0' selected='selected'>Hidden</option>";
                        }
                    ?>
                </select>
                <h3>Thumbnail image</h3>
                <div class="thumbnail-preview">
                    <?php
                        if (isset($video['thumbnail']) && $video['thumbnail'] != "") {
                            echo "<img src='../" . $video['thumbnail'] . "' id='thumbnail'>";
                        }
                        else {
                            echo "<img src='../media/images/no-thumbnail.jpg' id='thumbnail'>";
                        }
                    ?>
                </div>
                <input type="file" name="thumbnail" id="thumbnail-file">
                <input type="submit" value="Confirm">
            </form>
            <div style="clear:both;"></div>
        </div>
        <button class="remove-button" id="remove-button">DELETE VIDEO</button>
    </div>
    <?php include '../footer.php'; ?>
    <script src="js/video.js"></script>
</body>
</html>
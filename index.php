<?php

require 'session.php';
require 'connection.php';
include 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>WatchIT</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <div class="inner-content">
            <h2>Most popular uploads</h2>
            <div class="video-list">
                <?php 
                    $order = "popular";
                    include 'select_videos.php'; 
                ?>
            </div>
            <h2>Newest uploads</h2>
            <div class="video-list">
                <?php 
                    $order = "recent";
                    include 'select_videos.php'; 
                ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
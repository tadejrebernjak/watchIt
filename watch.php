<?php

require 'session.php';
require 'connection.php';
require 'select_video_details.php';
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
    <link rel="stylesheet" href="css/watch.css">    
    <title><?php echo $video['title'] . " - WatchIT"; ?> </title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <?php require 'searchbar.php' ?>
        <div class="inner-content">
            <div class="video-container">
                <h3><?php echo $video['title'] ?></h3>
                <p><?php echo $views ?> views - <?php echo getTimeDifference($video['upload_date']) ?></p>
                <video controls
                    src="<?php echo $video['video_url']?>"
                    poster="<?php echo $video['thumbnail'] ?>">
                </video>
                <div class="details">
                    <div class="channel-details">
                        <?php 
                            echo "<table class='uploader-info'>"
                            . "<tr>"
                                . "<td rowspan='2'>"
                                . "<a href='channel.php?id=" . $video['channelID'] . "'>";
                                    if (isset($video['pfp'])) {
                                        echo "<img src='" . $video['pfp'] . "' alt='pfp' class='uploader-pfp'>";
                                    }
                                    else {
                                        echo "<img src='media/images/default-pfp.jpg' alt='pfp' class='uploader-pfp'>";
                                    }
                                echo "</a></td><td>" . "<a href='channel.php?id=" . $video['channelID'] . "'>" . $video['username'] . "</a>". "</td>"
                            . "</tr>"
                            . "<tr>"
                                . "<td>" . $video['subscribers'] . " subscribers" . "</td>"
                            . "</tr>"
                        . "</table>"
                        ?>
                    </div>
                    <div class="video-details">
                        <div class="likes-dislikes">
                        <?php
                            include 'select_video_likes.php'; 
                            include 'select_video_dislikes.php';
                        ?>
                            <table>
                                <tr>
                                    <td>
                                        <div id="like-icon-container">
                                            <?php
                                                if (isset($userID)) {
                                                    if ($videoLiked == false) {
                                                        echo "<img src='media/images/like-icon.png' alt='like' id='like-button' onmouseover='likeHover(this)' onmouseout='likeHoverRelease(this)' onclick='likeCheck(" . $userID . ", " . $videoID . ")'>";
                                                    }
                                                    else {
                                                        echo "<img src='media/images/like-icon-checked.png' alt='like' id='like-button' onmouseover='likeCheckedHover(this)' onmouseout='likeCheckedHoverRelease(this)' onclick='likeUncheck(" . $userID . ", " . $videoID . ")'>";
                                                    }
                                                }
                                                else {
                                                    echo "<a href='login.php'>"
                                                        . "<img src='media/images/like-icon.png' alt='like' id='like-button' onmouseover='likeHover(this)' onmouseout='likeHoverRelease(this)'>"
                                                    . "</a>";
                                                }
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="dislike-icon-container">
                                            <?php 
                                                if (isset($userID)) {
                                                    if ($videoDisliked == false) {
                                                        echo "<img src='media/images/dislike-icon.png' alt='dislike' id='dislike-button' onmouseover='dislikeHover(this)' onmouseout='dislikeHoverRelease(this)' onclick='dislikeCheck(" . $userID . ", " . $videoID . ")'>";
                                                    }
                                                    else {
                                                        echo "<img src='media/images/dislike-icon-checked.png' alt='dislike' id='dislike-button' onmouseover='dislikeCheckedHover(this)' onmouseout='dislikeCheckedHoverRelease(this)' onclick='dislikeUncheck(" . $userID . ", " . $videoID . ")'>";
                                                    }
                                                }
                                                else {
                                                    echo "<a href='login.php'>"
                                                        . "<img src='media/images/dislike-icon.png' alt='dislike' id='dislike-button' onmouseover='dislikeHover(this)' onmouseout='dislikeHoverRelease(this)'>"
                                                    . "</a>";
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p id="likes-count"><?php echo $likes ?></p>
                                    </td>
                                    <td>
                                        <p id="dislikes-count"><?php echo $dislikes ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="description">
                    <h4>Description</h4>
                        <?php
                            if ($video['description'] != "") {
                                echo "<p>" .  $video['description'] . "</p>";
                            }
                            else {
                                echo "<p class='missing-text'>User was too lazy to write a description...</p>";
                            } 
                        ?>
                </div>
                <hr>
                <h4>Comments</h4>
                <div class="add-comment">
                    <?php 
                        if (isset($userID)) {
                            echo "<textarea id='comment-textarea' rows='5' placeholder='Your comment text...'></textarea>"
                            . "<button id='add-comment-button' onclick='addComment(this, " . $userID . ", " . $videoID . ")'>Add Comment</button>"
                            . "<div id='add-comment-response'></div>";
                        }
                    ?>
                </div>
                <div class="comments" id="comments-container">
                    <?php
                        include 'select_comments.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-content">

        </div>
    </div>
    <script src="js/watch.js"></script>
</body>
</html>
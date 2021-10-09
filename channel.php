<?php

require 'session.php';
require 'connection.php';
include 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
    include 'select_channel.php';
    $channelDescription = $channel['description'];
    if (isset($channel['banner'])) {
        echo "<style>"
            . ".bar {
                position: relative;
                z-index: 1;
                padding: 20px; 
            }"

            . ".bar::before {
                content: ' ';
                position: absolute;
                top: 0; 
                left: 0;
                width: 100%; 
                height: 100%;  
                opacity: .4; 
                z-index: -1;
                background: url(" . $channel['banner'] . ");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 10px;
            }"
        . "</style";
    }
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/channel.css">
    <title>WatchIT</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <div class="inner-content">
            <div class="top">
                <div class="bar">
                    <div class="channel-details">
                        <table>
                            <tr>
                                <td rowspan="2">
                                    <?php
                                        if (isset($channeluser['profile_picture_url'])) {
                                            echo "<img src='" . $channeluser['profile_picture_url'] . "' class='channel-pfp' alt='pfp'>";
                                        }
                                        else {
                                            echo "<img src='media/images/default-pfp.jpg' class='channel-pfp' alt='pfp'>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <h2><?php echo $channeluser['username'] ?></h2>
                                    <p class='subs-count'>
                                        <?php include 'select_channel_subscribers.php' ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="sub-container">
                        <?php 
                            if (isset($_SESSION['userID'])) {
                                if ($_SESSION['userID'] != $channeluser['id']) {
                                    include 'check_subscription.php';

                                    if ($subbed == true) {
                                        echo "<button class='unsub-button' id='unsub-button'>Subscribed</button>";
                                    }
                                    else {
                                        echo "<button class='sub-button' id='sub-button'>Subscribe</button>";
                                    }
                                }
                                else {
                                    echo "<a href='user.php?id=" . $_SESSION['userID'] . "'><button class='unsub-button'>Customize</button></a>";
                                }
                            }
                            else {
                                echo "<a href='login.php'>"
                                . "<button class='sub-button'>Subscribe</button>"
                                . "</a>";
                            }
                        ?>
                    </div>
                </div>
                <div class="nav">
                    <div class="tabs-centered">
                        <button class="tabs active" onclick="changeTab(this, 'home')">Home</button>
                        <button class="tabs" onclick="changeTab(this, 'videos')">Videos</button>
                        <button class="tabs" onclick="changeTab(this, 'about')">About</button>
                    </div>
                </div>
            </div>
            <div class="tabcontent" id="home">
                <h3>Recent uploads</h3>
                <div class="video-list-container" id="recent-container">
                    <button class="horizontal-videos-arrow arrow-left" id="recent-arrow-left"><</button>
                    <button class="horizontal-videos-arrow arrow-right" id="recent-arrow-right">></button>
                    <div class="video-list-horizontal" id="recent-videos">
                        <?php include 'select_channel_videos_recent.php' ?>
                    </div>
                </div>
                <h3>Most popular</h3>
                <div class="video-list-container" id="popular-container">
                    <button class="horizontal-videos-arrow arrow-left" id="popular-arrow-left"><</button>
                    <button class="horizontal-videos-arrow arrow-right" id="popular-arrow-right">></button>
                    <div class="video-list-horizontal" id="popular-videos">
                        <?php include 'select_channel_videos.php' ?>
                        <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="tabcontent" id="videos">
                <div class="video-list-vertical">
                    <?php include 'select_channel_videos_recent.php' ?>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="video-preview">
                        <div class='video-preview-content'>
                            <div class='thumbnail-container'>
                                <img src="media/images/no-thumbnail.jpg" alt="no thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabcontent" id="about">
                <div class="about-info">
                    <h3>Channel description</h3>
                    <?php 
                        if (isset($channelDescription) && $channelDescription != "") {
                            echo "<p>" . $channelDescription . "</p>";
                        }
                        else {
                            echo "<p class='missing-text'>" . "Oops, this user has yet to write a description :(" . "</p>";
                        }
                    ?>
                    <hr>
                    <?php
                        echo "<p>User joined on: " . date('d/m/Y' , strtotime($user['creation_date'])) . "</p>";
                        echo "<p>Channel visits: " . $views . "</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-content">

        </div>
    </div>
    <script src="js/channel.js"></script>
</body>
</html>
<?php

require 'session.php';
require 'connection.php';
include 'functions.php';

if (!isset($_GET['q'])) {
    header("Location:index.php");
}
$query = $_GET['q'];

if (!isset($_GET['t'])) {
    header("Location:search.php?q=$query&t=all");
}
$queryType = $_GET['t'];

if ($queryType != "all" && $queryType != "videos" && $queryType != "channels" && $queryType != "uploaders") {
    header("Location:search.php?q=$query&t=all");
}

if (!isset($_GET['s'])) {
    header("Location:search.php?q=$query&t=$queryType&s=popular");
}

$sort = $_GET['s'];

if ($sort != "popular" && $sort != "recent") {
    header("Location:search.php?q=$query&t=$queryType&s=popular");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/search.css">
    <title>WatchIT</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <div class="inner-content">
                <div class="nav">
                    <div class="tabs-centered">
                        <a href="search.php?q=<?php echo $query ?>&t=all"><button class="tabs" id="all-button">All</button></a>
                        <a href="search.php?q=<?php echo $query ?>&t=videos"><button class="tabs" id="videos-button">Videos</button></a>
                        <a href="search.php?q=<?php echo $query ?>&t=channels"><button class="tabs" id="channels-button">Channels</button></a>
                        <a href="search.php?q=<?php echo $query ?>&t=uploaders"><button class="tabs" id="uploaders-button">Uploaders</button></a>
                    </div>
                    <div class="tabs-centered">
                        <a href="search.php?q=<?php echo $query ?>&t=<?php echo $queryType ?>&s=popular"><button class="tabs tabs-two" id="popular-button">popular</button></a>
                        <a href="search.php?q=<?php echo $query ?>&t=<?php echo $queryType ?>&s=recent"><button class="tabs tabs-two" id="recent-button">recent</button></a>
                    </div>
                </div>
            <?php
                if ($queryType == "all") {
                    echo "<h2>Showing all results for '$query'</h2>";
                }
                else if ($queryType == "videos") {
                    echo "<h2>Showing video results for '$query'</h2>";
                }
                else if ($queryType == "channels") {
                    echo "<h2>Showing channel results for '$query'</h2>";
                }
                else if ($queryType == "uploaders") {
                    echo "<h2>Showing video results by '$query'</h2>";
                }
            ?>
            <div class="search-results">
                <?php
                    $query = strtolower($query);
                    $noresults = true;

                    if ($queryType == "all") {
                        //channels with same username as query

                        $thisQuery = $query;

                        $sql = "SELECT c.*, u.username, u.profile_picture_url AS pfp 
                        FROM channels c INNER JOIN users u ON u.id=c.user_id 
                        WHERE (LOWER(u.username) = LOWER(?))
                        ORDER BY subscribers DESC";
                        include "search_channels.php";

                        //videos with same or similar title as query

                        $thisQuery = "%$query%";
                        $params = 1;

                        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                        INNER JOIN users u ON u.id=c.user_id 
                        WHERE (listed = ?) AND (LOWER(title) LIKE ?)
                        ORDER BY views DESC";
                        include "search_videos.php";

                        //videos by channel with same username as query

                        $thisQuery = "%$query%";
                        $thisQueryExact = $query;
                        $params = 2;

                        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                        INNER JOIN users u ON u.id=c.user_id 
                        WHERE (listed = ?) AND (LOWER(username) = ?) AND (LOWER(title) NOT LIKE ?)
                        ORDER BY views DESC";
                        include 'search_videos.php';

                        //videos with same or similar description as query

                        $thisQuery = "%$query%";
                        $thisQueryExact = $query;
                        $params = 3;

                        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                        INNER JOIN users u ON u.id=c.user_id 
                        WHERE (listed = ?) AND (LOWER(username) != ?) AND (LOWER(v.description) LIKE ?) AND (LOWER(title) NOT LIKE ?)
                        ORDER BY views DESC";
                        include "search_videos.php";

                        if ($noresults == true) {
                            //videos by channel with similar username as query

                            $thisQuery = "%$query%";
                            $thisQueryExact = $query;
                            $params = 2;

                            $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                            FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                            INNER JOIN users u ON u.id=c.user_id 
                            WHERE (listed = ?) AND (LOWER(username) != ?) AND (LOWER(username) LIKE ?)
                            ORDER BY views DESC";
                            include 'search_videos.php';
                        }
                    }
                    else if ($queryType == "videos") {
                        //videos with same or similar title as query

                        $thisQuery = "%$query%";
                        $params = 1;

                        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                        INNER JOIN users u ON u.id=c.user_id 
                        WHERE (listed = ?) AND (LOWER(title) LIKE ?)
                        ORDER BY views DESC";
                        include "search_videos.php";

                        //videos with same or similar description as query

                        $thisQuery = "%$query%";
                        $thisQueryExact = $thisQuery;
                        $params = 2;

                        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                        INNER JOIN users u ON u.id=c.user_id 
                        WHERE (listed = ?) AND (LOWER(v.description) LIKE ?) AND (LOWER(title) NOT LIKE ?)
                        ORDER BY views DESC";
                        include "search_videos.php";
                    }
                    else if ($queryType == "channels") {
                        //channels with same username as query

                        $thisQuery = $query;

                        $sql = "SELECT c.*, u.username, u.profile_picture_url AS pfp 
                        FROM channels c INNER JOIN users u ON u.id=c.user_id 
                        WHERE (LOWER(u.username) = LOWER(?))
                        ORDER BY subscribers DESC";
                        include "search_channels.php";
                    }
                    else if ($queryType == "uploaders") {
                        //videos by channel with same username as query

                        $thisQuery = $query;
                        $params = 1;

                        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                        INNER JOIN users u ON u.id=c.user_id 
                        WHERE (listed = ?) AND (LOWER(username) = ?)
                        ORDER BY views DESC";
                        include 'search_videos.php';

                        //videos by channel with similar username as query

                        $thisQuery = "%$query%";
                        $thisQueryExact = $query;
                        $params = 2;

                        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
                        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                        INNER JOIN users u ON u.id=c.user_id 
                        WHERE (listed = ?) AND (LOWER(username) != ?) AND (LOWER(username) LIKE ?)
                        ORDER BY views DESC";
                        include 'search_videos.php';
                    }

                    if ($noresults == true) {
                        echo "<h3 class='no-results'>No results found :(</h3>";
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/search.js"></script>
</body>
</html>
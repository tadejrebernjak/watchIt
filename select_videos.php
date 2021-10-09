<?php 
    if ($order == "popular") {
        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
        INNER JOIN users u ON u.id=c.user_id 
        WHERE (listed = 1) 
        ORDER BY views DESC";
    }
    else if ($order == "recent") {
        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
        FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
        INNER JOIN users u ON u.id=c.user_id 
        WHERE (listed = 1) 
        ORDER BY upload_date DESC";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $videos = $stmt->fetchAll();

    foreach ($videos as $video) {
        $uploadedTimeDifference = getTimeDifference($video['upload_date']);

        echo
        "<div class='video-preview'>"
            . "<div class='thumbnail-container'>"
                . "<a href='watch.php?id=" . $video['id'] . "'>";
        
        if (isset($video['thumbnail']) && $video['thumbnail'] != "") {           
            echo "<img src='" . $video['thumbnail'] . "'>";
        }
        else {
            echo "<img src='media/images/no-thumbnail.jpg' alt='noThumbnail'>";
        }

        echo "</a>"
            ."</div>"
            . "<div class='video-info'>"
                . "<a href='watch.php?id=" . $video['id'] . "'>"
                . $video['title']
                . "</a>"
                . "<p>" . $uploadedTimeDifference . "</p>"
            . "</div>"
            . "<hr>"
            . "<table class='uploader-info'>"
                . "<tr>"
                    . "<td rowspan='2'>"
                    . "<a href='channel.php?id=" . $video['channelID'] . "'>";
                        if (isset($video['pfp'])) {
                            echo "<img src='" . $video['pfp'] . "' alt='pfp' class='uploader-pfp'>";
                        }
                        else {
                            echo "<img src='media/images/default-pfp.jpg' alt='pfp' class='uploader-pfp'>";
                        }
                    echo "</a></td><td>" . $video['views'] . " views </td>"
                . "</tr>"
                . "<tr>"
                    . "<td>" . "By " . "<a href='channel.php?id=" . $video['channelID'] . "'>" . $video['username'] . "</a>"
                . "</tr>"
            . "</table>"
        . "</div>";
    }
?>
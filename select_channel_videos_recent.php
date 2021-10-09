<?php
    if (isset($_SESSION['userID']) && $_SESSION['userID'] === $channeluser['id']) {
        $yourChannel = true;

        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
        FROM videos v INNER JOIN channels c ON c.id=v.channel_id INNER JOIN users u ON u.id=c.user_id 
        WHERE (channel_id = ?) 
        ORDER BY upload_date DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$channeluser['id']]);
    }
    else {
        $yourChannel = false;

        $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp 
        FROM videos v INNER JOIN channels c ON c.id=v.channel_id INNER JOIN users u ON u.id=c.user_id 
        WHERE (listed = ?) AND (channel_id = ?) 
        ORDER BY upload_date DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([1, $channeluser['id']]);
    }


    $videos = $stmt->fetchAll();

    foreach ($videos as $video) {
        $uploadedTimeDifference = getTimeDifference($video['upload_date']);

        echo
        "<div class='video-preview'>"
        . "<div class='video-preview-content'>"
            . "<div class='thumbnail-container'>"
                . "<a href='watch.php?id=" . $video['id'] . "'>";
        
        if (isset($video['thumbnail']) && $video['thumbnail'] != "") {           
            echo "<img src='" . $video['thumbnail'] . "'>";
        }
        else {
            echo "<img src='media/images/no-thumbnail.jpg'>";
        }

        echo "</a>"
            ."</div>"
            . "<div class='video-info'>"
                . "<a href='watch.php?id=" . $video['id'] . "'>"
                . $video['title']
                . "</a>"
                . "<p>" . $uploadedTimeDifference . " - " . $video['views'] . " views</p>";
                if ($yourChannel == true) {
                    if ($video['listed'] == 0) {
                        echo "<p>(hidden)</p>";
                    }
                    echo "<a href='edit.php?id=" . $video['id'] . "'>"
                    . "<i class='fas fa-pen edit-video'></i>"
                    . "</a>";
                }
            echo "</div>"
        . "</div>"
        . "</div>";
    }
?>
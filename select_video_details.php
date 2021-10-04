<?php
    $videoID = $_GET['id'];

    $sql = "SELECT v.*, c.id AS channelID, u.username AS username, u.profile_picture_url AS pfp, c.subscribers AS subscribers FROM videos v INNER JOIN channels c ON c.id=v.channel_id INNER JOIN users u ON u.id=c.user_id WHERE (v.id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID]);

    $video = $stmt->fetch();

    $views = addView($pdo, $videoID, (int)$video['views']);

    function addView($pdo, $videoID, $views) {
        $views++;

        if (isset($_SESSION['userID'])) {
            $sql = "UPDATE videos SET views=? WHERE (id=?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$views, $videoID]);
        }

        $sql = "SELECT views FROM videos WHERE (id=?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$videoID]);

        $result = $stmt->fetch();
        return $result['views'];
    }
?>
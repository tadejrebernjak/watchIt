<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $videoID = $_POST['videoid'];

    $sql = "SELECT * FROM videos WHERE (id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID]);

    $video = $stmt->fetch();

    $channelID = getChannelID($userID, $pdo);

    if ($channelID == $video['channel_id']) {
        $sql = "DELETE FROM videos WHERE (id = ?) AND (channel_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$videoID, $channelID]);

        if (is_file($video['video_url'])) {
            unlink($video['video_url']);
        }

        if (is_file($video['thumbnail'])) {
            unlink($video['thumbnail']);
        }
    }

    function getChannelID($userID, $pdo) {
        $sql = "SELECT id FROM channels WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID]);

        $channel = $stmt->fetch();
        $channelID = $channel['id'];

        return $channelID;
    }
?>
<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $videoID = $_POST['videoid'];
    $channelID = getChannelID($userID, $pdo);

    $sql = "DELETE FROM videos WHERE (id = ?) AND (channel_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID, $channelID]);

    function getChannelID($userID, $pdo) {
        $sql = "SELECT id FROM channels WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID]);

        $channel = $stmt->fetch();
        $channelID = $channel['id'];

        return $channelID;
    }
?>
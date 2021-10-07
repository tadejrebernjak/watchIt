<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $channelID = $_POST['channelid'];

    $sql = "SELECT * FROM subscriptions WHERE (user_id = ?) AND (channel_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $channelID]);

    if ($stmt->rowCount() > 0) {
        $sql = "DELETE FROM subscriptions WHERE (user_id = ?) AND (channel_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $channelID]);
    }

    $sql = "INSERT INTO subscriptions (channel_id, user_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$channelID, $userID]);
?>
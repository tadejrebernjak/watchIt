<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $channelID = $_POST['channelid'];

    $sql = "DELETE FROM subscriptions WHERE (user_id = ?) AND (channel_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $channelID]);
    
?>
<?php
    include 'connection.php';

    $userID = $_POST['userid'];
    $videoID = $_POST['videoid'];

    $sql = "SELECT * FROM video_likes WHERE (user_id = ?) AND (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $videoID]);

    if ($stmt->rowCount() > 0) {
        $sql = "DELETE FROM video_likes WHERE (user_id = ?) AND (video_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $videoID]);
    }

    $sql = "SELECT * FROM video_dislikes WHERE (user_id = ?) AND (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $videoID]);

    if ($stmt->rowCount() > 0) {
        $sql = "DELETE FROM video_dislikes WHERE (user_id = ?) AND (video_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $videoID]);
    }

    $sql = "INSERT INTO video_likes (video_id, user_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID, $userID]);


?>
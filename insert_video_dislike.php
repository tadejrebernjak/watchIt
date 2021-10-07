<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $videoID = $_POST['videoid'];

    $sql = "SELECT * FROM video_dislikes WHERE (user_id = ?) AND (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $videoID]);

    if ($stmt->rowCount() > 0) {
        $sql = "DELETE FROM video_dislikes WHERE (user_id = ?) AND (video_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $videoID]);
    }

    $sql = "SELECT * FROM video_likes WHERE (user_id = ?) AND (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $videoID]);

    if ($stmt->rowCount() > 0) {
        $sql = "DELETE FROM video_likes WHERE (user_id = ?) AND (video_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $videoID]);
    }

    $sql = "INSERT INTO video_dislikes (video_id, user_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID, $userID]);


?>
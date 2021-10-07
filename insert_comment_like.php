<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $commentID = $_POST['commentid'];

    $sql = "SELECT * FROM video_comment_likes WHERE (user_id = ?) AND (comment_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $commentID]);

    if ($stmt->rowCount() > 0) {
        $sql = "DELETE FROM video_comment_likes WHERE (user_id = ?) AND (comment_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $commentID]);
    }

    $sql = "INSERT INTO video_comment_likes (comment_id, user_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$commentID, $userID]);


?>
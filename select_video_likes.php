<?php
    $sql = "SELECT COUNT(*) AS likesCount FROM video_likes WHERE (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID]);

    $result = $stmt->fetch();
    $likes = $result['likesCount'];
    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];

        $sql = "SELECT * FROM video_likes WHERE (user_id = ?) AND (video_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $videoID]);

        if ($stmt->rowCount() == 1) {
            $videoLiked = true;
        }
        else {
            $videoLiked = false;
        }
    }
?>
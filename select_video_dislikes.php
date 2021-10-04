<?php
    $sql = "SELECT COUNT(*) AS dislikesCount FROM video_dislikes WHERE (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID]);

    $result = $stmt->fetch();
    $dislikes = $result['dislikesCount'];
    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];

        $sql = "SELECT * FROM video_dislikes WHERE (user_id = ?) AND (video_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $videoID]);

        if ($stmt->rowCount() == 1) {
            $videoDisliked = true;
        }
        else {
            $videoDisliked = false;
        }
    }
?>
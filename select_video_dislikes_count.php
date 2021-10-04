<?php
    include 'connection.php';

    $videoID = $_POST['videoid'];

    $sql = "SELECT COUNT(*) AS dislikesCount FROM video_dislikes WHERE (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID]);

    $result = $stmt->fetch();
    $dislikes = $result['dislikesCount'];

    echo $dislikes;
?>
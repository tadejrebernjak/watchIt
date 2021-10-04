<?php
    include 'connection.php';

    $videoID = $_POST['videoid'];

    $sql = "SELECT COUNT(*) AS likesCount FROM video_likes WHERE (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID]);

    $result = $stmt->fetch();
    $likes = $result['likesCount'];

    echo $likes;
?>
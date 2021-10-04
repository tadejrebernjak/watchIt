<?php
    include 'connection.php';

    $commentID = $_POST['commentid'];

    $sql = "SELECT COUNT(*) AS likesCount FROM video_comment_likes WHERE (comment_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$commentID]);

    $result = $stmt->fetch();
    $likes = $result['likesCount'];

    echo $likes;
?>
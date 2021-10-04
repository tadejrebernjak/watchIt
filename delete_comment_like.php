<?php
    include 'connection.php';

    $userID = $_POST['userid'];
    $commentID = $_POST['commentid'];

    $sql = "DELETE FROM video_comment_likes WHERE (user_id = ?) AND (comment_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $commentID]);


?>
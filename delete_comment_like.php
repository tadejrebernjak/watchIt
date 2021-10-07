<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $commentID = $_POST['commentid'];

    $sql = "DELETE FROM video_comment_likes WHERE (user_id = ?) AND (comment_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $commentID]);


?>
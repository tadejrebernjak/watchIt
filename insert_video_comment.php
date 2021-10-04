<?php 
    include 'connection.php';

    $comment = nl2br($_POST['comment']);
    $videoID = $_POST['videoid'];
    $userID = $_POST['userid'];

    $sql = "INSERT INTO video_comments (comment, video_id, user_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$comment, $videoID, $userID]);
?>
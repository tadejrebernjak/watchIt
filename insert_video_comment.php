<?php 
    include 'connection.php';
    include 'session.php';

    $comment = nl2br($_POST['comment']);
    $videoID = $_POST['videoid'];
    $userID = $_SESSION['userID'];

    $sql = "INSERT INTO video_comments (comment, video_id, user_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$comment, $videoID, $userID]);
?>
<?php
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $videoID = $_POST['videoid'];

    $sql = "DELETE FROM video_dislikes WHERE (user_id = ?) AND (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $videoID]);


?>
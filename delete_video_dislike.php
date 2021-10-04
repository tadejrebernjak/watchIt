<?php
    include 'connection.php';

    $userID = $_POST['userid'];
    $videoID = $_POST['videoid'];

    $sql = "DELETE FROM video_dislikes WHERE (user_id = ?) AND (video_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $videoID]);


?>
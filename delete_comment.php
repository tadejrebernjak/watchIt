<?php 
    include 'connection.php';

    $commentID = $_POST['commentid'];

    $sql = "DELETE FROM video_comments WHERE (id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$commentID]);
?>
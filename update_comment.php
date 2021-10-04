<?php 
    include 'connection.php';

    $comment = nl2br($_POST['comment']);
    $commentID = $_POST['commentid'];

    $sql = "UPDATE video_comments SET comment = ?, edited = ? WHERE (id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$comment, 1, $commentID]);
?>
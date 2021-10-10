<?php
    include '../connection.php';

    if (!isset($_SESSION['adminID']))
        include '../session.php';
    
    if (isset($_SESSION['adminID'])) {  
        $videoID = $_POST['videoid'];

        $sql = "SELECT * FROM videos WHERE (id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$videoID]);

        $video = $stmt->fetch();;

        $sql = "DELETE FROM videos WHERE (id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$videoID]);

        if (is_file("../" . $video['video_url'])) {
            unlink("../" . $video['video_url']);
        }

        if (is_file("../" . $video['thumbnail'])) {
            unlink("../" . $video['thumbnail']);
        }
    }
?>
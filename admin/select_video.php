<?php
    include '../connection.php';

    if (!isset($_SESSION['adminID']))
        include '../session.php';
    
    if (isset($_SESSION['adminID'])) {     
        $sql = "SELECT * FROM videos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$videoID]);

        $video = $stmt->fetch();
    }
?> 
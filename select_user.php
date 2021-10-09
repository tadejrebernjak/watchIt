<?php 
    
    $userID = $_SESSION['userID'];

    $sql =  "SELECT u.*, c.id AS channelID, c.banner_picture_url AS banner, c.description AS channelDescription FROM users u INNER JOIN channels c ON u.id=c.user_id WHERE u.id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID]);

    $user = $stmt->fetch();

?>
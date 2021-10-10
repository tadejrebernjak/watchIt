<?php
    include '../connection.php';

    if (!isset($_SESSION['adminID']))
        include '../session.php';
    
    if (isset($_SESSION['adminID'])) {     
        $sql = "SELECT u.*, c.description, c.banner_picture_url
        FROM users u INNER JOIN channels c ON u.id=c.user_id 
        WHERE (u.id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID]);

        $user = $stmt->fetch();
    }
?>
        
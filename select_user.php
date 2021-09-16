<?php 
    
    $userID = $_SESSION['userID'];

    $sql =  "SELECT * FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID]);

    $user = $stmt->fetch();

?>
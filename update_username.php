<?php 
    include 'connection.php';

    $username = $_POST['username'];
    $userID = $_POST['userid'];

    $sql =  "UPDATE users SET username=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $userID]);

    echo 1;
?>
<?php 
    include 'connection.php';
    include 'session.php';

    $username = $_POST['username'];
    $userID = $_SESSION['userID'];

    $sql =  "UPDATE users SET username=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $userID]);

    echo 1;
?>
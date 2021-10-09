<?php
    include 'connection.php';
    include 'session.php';

    $description = nl2br($_POST['description']);
    $userID = $_SESSION['userID'];

    $sql = "UPDATE channels SET description = ? WHERE (id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$description, $userID]);

    echo 1;
?>
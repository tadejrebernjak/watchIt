<?php
    require '../connection.php';

    $sql = "SELECT * FROM admins WHERE (id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['adminID']]);

    $admin = $stmt->fetch();
?>
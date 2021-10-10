<?php
    include '../connection.php';

    if (!isset($_SESSION['adminID']))
        include '../session.php';
    
    if (isset($_SESSION['adminID'])) {  
        $userID = $_POST['userid'];
        
        $sql = "DELETE FROM users WHERE (id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID]);

        $user = $stmt->fetch();
    }
?>
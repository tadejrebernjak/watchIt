<?php 
    include 'connection.php';
    include 'session.php';

    $currentPassword = $_POST['password'];
    $newPassword = $_POST['newpassword'];
    $userID = $_SESSION['userID'];

    $sql = "SELECT password FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID]);

    $pass = $stmt->fetch();

    if (password_verify($currentPassword, $pass['password'])) {
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql =  "UPDATE users SET password=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newPasswordHash, $userID]);

        echo "1";
    }
    else {
        echo "<p class='error-text align-left'>Incorrect password</p>   ";
    }
?>
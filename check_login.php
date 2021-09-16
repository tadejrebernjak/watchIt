<?php 

require 'session.php';
require 'connection.php';

$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() == 1) {
    $user = $stmt->fetch();

    if (password_verify($pass, $user['password'])) {
        $_SESSION['userID'] = $user['id'];
        echo "1";
    }
    else {
        echo "<p class='error-text'>Incorrect email or password</p>";
    }
}
else {
    echo "<p class='error-text'>Incorrect email or password</p>";
}

?>
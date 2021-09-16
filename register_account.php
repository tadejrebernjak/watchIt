<?php 

require 'connection.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$pass = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    echo "<p class='error-text'>An account with this email already exists</p>";
}
else {
    $sql = "INSERT INTO users (email, username, password) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email,$username,$pass]);

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();
    $userID = $user['id'];

    $sql = "INSERT INTO channels (subscribers, views, user_id) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([0,0,$userID]);

    echo "1";
}

?>
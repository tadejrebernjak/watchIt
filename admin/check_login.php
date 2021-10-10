<?php 

require '../session.php';
require '../connection.php';

$username = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT * FROM admins WHERE username=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);

if ($stmt->rowCount() == 1) {
    $admin = $stmt->fetch();

    if (password_verify($pass, $admin['password'])) {
        $_SESSION['adminID'] = $admin['id'];
        echo "1";
    }
    else {
        echo "<p class='error-text'>Incorrect username or password</p>";
    }
}
else {
    echo "<p class='error-text'>Incorrect username or password</p>";
}

?>
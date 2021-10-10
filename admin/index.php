<?php

require '../session.php';
require '../connection.php';
include '../functions.php';

if (!isset($_SESSION['adminID'])) {
    header("Location: login.php");
}

include 'select_admin.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Admin</title>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <div class="options">
            <a href="channels.php">
                <button class="option">Channels</button>
            </a>
            <a href="videos.php">
                <button class="option">Videos</button>
            </a>
        </div>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>
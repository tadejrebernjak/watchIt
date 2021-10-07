<?php
    if (isset($_SESSION['userID'])) {
        include 'select_user.php';
    }
?>

<link rel="stylesheet" type="text/css" href="css/header.css">
<script src="https://kit.fontawesome.com/f7a42c090c.js" crossorigin="anonymous"></script>
<script src="js/menu.js"></script>
<script src="js/header.js"></script>
<div class="menu" id="menu">
    <header>
        <div class="menu-icon-container">
            <img class="menu-icon" id="menu-close-icon" src="media/images/menu.png" alt="menu icon" onmouseover="menuHover(this)" onmouseout="menuHoverRelease(this)" onclick="closeMenu()">
        </div>
        <div class="logo-container-menu">
            <a href="index.php"><img src="media/images/logo.png" alt="WatchIT"></a>
        </div>
    </header>
    <?php include 'menu.php' ?>
</div>
<div class="header">
    <div class="menu-icon-container">
        <img class="menu-icon" id="menu-open-icon" src="media/images/menu.png" alt="menu icon" onmouseover="menuHover(this)" onmouseout="menuHoverRelease(this)" onclick="openMenu()">
    </div>
    <div class="header-content">
        <div class="logo-container">
            <a href="index.php"><img src="media/images/logo.png" alt="WatchIT"></a>
        </div>
        <div class="account-info">
            <?php 
                if (!isset($_SESSION['userID'])) {
                    echo
                    "<ul>"
                        . "<li><a href='login.php'>Login</a></li>"
                        . "<li><a href='register.php'>Register</a></li>"
                    . "</ul>";
                }
                else {
                    echo
                    "<ul>"
                        . "<li>" . "<a href='upload.php'>" . "<img src='media/images/upload-video-icon.png' class='upload-icon' onmouseover='uploadHover(this)' onmouseout='uploadHoverRelease(this)'>" . "</a>"
                        . "<li>" . "<a class='username' href='user.php'>" . $user['username'] . "</a>" . "</li>";

                    echo "<li>" . "<a href='channel.php?id=" . $user['channelID'] . "'>";
                    if ($user['profile_picture_url'] == "") {
                        echo "<img src='media/images/default-pfp.jpg' alt='pfp' class='header-pfp'>";
                    }
                    else {
                        echo "<img src='" . $user['profile_picture_url'] . "' class='header-pfp'>";
                    }
                    echo "</a></li>";

                    echo
                        "<li><a href='logout.php' class='logout'>Logout</a></li>"
                    . "</ul>";
                }
            ?>
        </div>
    </div>
</div>
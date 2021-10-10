<?php
    if (isset($_SESSION['userID'])) {
        include 'select_user.php';
    }
?>

<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/searchbar.css">
<script src="https://kit.fontawesome.com/f7a42c090c.js" crossorigin="anonymous"></script>
<script src="js/menu.js"></script>
<script src="js/header.js"></script>
<div class="menu" id="menu">
    <header>
        <div class="menu-icon-container-menu">
            <img class="menu-icon" id="menu-close-icon" src="media/images/menu.png" alt="menu icon" onmouseover="menuHover(this)" onmouseout="menuHoverRelease(this)" onclick="closeMenu()">
        </div>
        <div class="logo-container-menu">
            <a href="index.php"><img src="media/images/logo.png" alt="WatchIT"></a>
        </div>
    </header>
    <?php include 'menu.php' ?>
</div>
<div class="header-container">
<div class="header">
    <div class="menu-icon-container">
        <img class="menu-icon" id="menu-open-icon" src="media/images/menu.png" alt="menu icon" onmouseover="menuHover(this)" onmouseout="menuHoverRelease(this)" onclick="openMenu()">
    </div>
    <div class="header-content">
        <div class="menu-icon-container-two">
            <img class="menu-icon" id="menu-open-icon-two" src="media/images/menu.png" alt="menu icon" onmouseover="menuHover(this)" onmouseout="menuHoverRelease(this)" onclick="openMenu()">
        </div>
        <div class="logo-container">
            <a href="index.php"><img src="media/images/logo.png" alt="WatchIT"></a>
        </div>
        <div class="account-info">
            <?php 
                if (!isset($_SESSION['userID'])) {
                    echo
                    "<ul>"
                        . "<li>"
                        . "<a href='login.php'>"
                            . "<button class='account-button'><i class='fas fa-sign-in-alt'></i> Sign in</button>"
                        . "</a>"
                        . "</li>"
                        . "<li>"
                        . "<a href='register.php'>"
                            . "<button class='account-button'><i class='fas fa-user-plus'></i> Sign up</button>"
                        . "</a>"
                        . "</li>"
                    . "</ul>";
                }
                else {
                    echo
                    "<ul>"
                        . "<li>" . "<a href='upload.php'>" . "<i class='fas fa-arrow-circle-up upload-icon'></i>" . "</a>"
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
                        "<li>"
                        . "<a href='logout.php'>"
                            . "<button class='account-button'><i class='fas fa-sign-out-alt'></i> Sign out</button>"
                        . "</a>"
                        . "</li>"
                    . "</ul>";
                }
            ?>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search" id="search-text"></input>
            <button id="search-button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>
</div>
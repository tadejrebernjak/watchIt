<ul>
    <a href="index.php"><li><i class="fas fa-home"></i>Home</li></a>
    <a href="user.php"><li><i class="fas fa-cog"></i>User settings</li></a>
    
    <?php 
        if (isset($_SESSION['userID'])) {
            echo "<a href='channel.php?id=" . $user['channelID'] . "'>"
            . "<li>" . "<i class='fas fa-user'></i>Your channel" . "</li>" 
            . "</a>";
        }
        else {
            echo "<a href='login.php'>"
            . "<li>" . "<i class='fas fa-user'></i>Your channel" . "</li>" 
            . "</a>";
        }
    ?>
</ul>

<?php
    if (isset($_SESSION['userID'])) {
        echo "<p class='menu-heading'>Subscribed channels</p>";

        include 'select_subscriptions.php';

    }
?>

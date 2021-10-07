<?php
    $sql = "SELECT * FROM subscriptions WHERE (user_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['userID']]);
    $subscriptions = $stmt->fetchAll();

    if ($stmt->rowCount() > 0) {
        echo "<ul>";

        foreach ($subscriptions as $subscription) {
            $sql = "SELECT * FROM channels c INNER JOIN users u ON u.id=c.user_id WHERE (c.id = ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$subscription['channel_id']]);

            $channel = $stmt->fetch();

            echo "<a href='channel.php?id=". $subscription['channel_id'] . "'>"
            . "<li>";

            if ($channel['profile_picture_url'] == "") {
                echo "<img src='media/images/default-pfp.jpg' alt='pfp' class='menu-pfp'>";
            }
            else {
                echo "<img src='" . $channel['profile_picture_url'] . "' class='menu-pfp'>";
            }

            echo "<p class='menu-channel-name'>" . $channel['username'] . "</p>"
            . "</li>"
            . "</a>";
        }

        echo "</ul>";
    }
    else {
        echo "<p class='missing-text'>You have not subscribed to anyone yet</p>";
    }
?>
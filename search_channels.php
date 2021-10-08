<?php
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$query]);

    if ($stmt->rowCount() > 0) {
        $noresults = false;
    }

    $channels = $stmt->fetchAll();

    $length = count($channels);
    $i = 0;
    foreach ($channels as $channeluser) {
        echo 
        "<div class='result'>"
        . "<table class='channel-result'>"
        . "<tr>"
        . "<td rowspan='2'>";
        if (isset($channeluser['pfp'])) {
            echo
            "<a href='channel.php?id=" . $channeluser['id'] . "'>" 
            . "<img src='" . $channeluser['pfp'] . "' alt='pfp' class='channel-result-pfp'>"
            . "</a>";
        }
        else {
            echo
            "<a href='channel.php?id=" . $channeluser['id'] . "'>" 
            . "<img src='media/images/default-pfp.jpg' alt='pfp' class='channel-result-pfp'>"
            . "</a>";
        }
        echo
        "</td>"
        . "<td>" . "<a href='channel.php?id=" . $channeluser['id'] . "' class='result-title'>" . $channeluser['username'] . "</a>" . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td>"
        . "<p class='result-details'>";
        include 'select_channel_subscribers.php';
        echo
        "</p>"
        . "</td>"
        . "</tr>"
        . "</table>"
        . "</div>";
        
        if (++$i != $length) {
            echo "<hr>";
        }
    }
?>
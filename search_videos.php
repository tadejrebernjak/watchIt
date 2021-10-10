<?php
    if ($sort == "recent") {
        $sql = str_replace("ORDER BY views DESC", "ORDER BY upload_date DESC", $sql);
    }

    $stmt = $pdo->prepare($sql);
    if ($params == 1) {
        $stmt->execute([1, $thisQuery]);
    }
    else if ($params == 2) {
        $stmt->execute([1, $thisQueryExact, $thisQuery]);
    }
    else if ($params == 3) {
        $stmt->execute([1, $thisQueryExact, $thisQuery, $thisQuery]);
    }

    if ($stmt->rowCount() > 0) {
        $noresults = false;
    }

    $videos = $stmt->fetchAll();

    $length = count($videos);
    $i = 0;
    foreach ($videos as $index => $video) {
        $uploadedTimeDifference = getTimeDifference($video['upload_date']);

        echo
        "<div class='result'>"
        . "<div class='thumbnail-container'>"
        . "<a href='watch.php?id=" . $video['id'] . "'>"
        . "<div class='result-thumbnail-container'>";
        
        if (isset($video['thumbnail']) && $video['thumbnail'] != "") {           
            echo "<img src='" . $video['thumbnail'] . "' class='result-thumbnail'>";
        }
        else {
            echo "<img src='media/images/no-thumbnail.jpg' class='result-thumbnail'>";
        }

        echo 
        "</div>"
        . "</a>"
        . "</div>"
        . "<div class='details-container'>"
        . "<a href='watch.php?id=" . $video['id'] . "' class='result-title'>"
        . $video['title']
        . "<p class='result-details'>" . $video['views'] . " views, " . $uploadedTimeDifference . "</p>"
        . "<a href='channel.php?id=" . $video['channelID'] . "'>";

        if (isset($video['pfp'])) {
            echo "<img src='" . $video['pfp'] . "' alt='pfp' class='uploader-pfp'>";
        }
        else {
            echo "<img src='media/images/default-pfp.jpg' alt='pfp' class='uploader-pfp'>";
        }

        echo 
        "</a>"
        . "<a href='channel.php?id=" . $video['channelID'] . "' class='result-uploader-username'>" . $video['username'] . "</a>"
        . "<p class='result-description'>" . $video['description'] . "</p>"
        . "</div>"
        . "</div>";





        /*echo "<table>"
        . "<tr>"
        . "<td rowspan='4' class='thumbnail-cell'>"
        . "<a href='watch.php?id=" . $video['id'] . "'>"
        . "<div class='result-thumbnail-container'>";
        
        if (isset($video['thumbnail']) && $video['thumbnail'] != "") {           
            echo "<img src='" . $video['thumbnail'] . "' class='result-thumbnail'>";
        }
        else {
            echo "<img src='media/images/no-thumbnail.jpg' class='result-thumbnail'>";
        }

        echo 
        "</div>"
        . "</a>"
        . "</td>"
        . "<td>"
        . "<a href='watch.php?id=" . $video['id'] . "' class='result-title'>"
        . $video['title']
        . "</a>"
        . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td>"
        . "<p class='result-details'>" . $video['views'] . " views, " . $uploadedTimeDifference . "</p>"
        . "</td>"
        . "</tr>"
        . "</tr>"
        . "<td>"
        . "<a href='channel.php?id=" . $video['channelID'] . "'>";

        if (isset($video['pfp'])) {
            echo "<img src='" . $video['pfp'] . "' alt='pfp' class='uploader-pfp'>";
        }
        else {
            echo "<img src='media/images/default-pfp.jpg' alt='pfp' class='uploader-pfp'>";
        }

        echo 
        "</a>"
        . "<a href='channel.php?id=" . $video['channelID'] . "' class='result-uploader-username'>" . $video['username'] . "</a>"
        . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td>"
        . "<p class='result-description'>" . $video['description'] . "</p>"
        . "</td>"
        . "</tr>"
        . "</table>"
        . "</div>";*/

        if (++$i != $length) {
            echo "<hr>";
        }
    }
?>
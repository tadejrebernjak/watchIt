<?php
    include '../connection.php';

    if (!isset($_SESSION['adminID']))
        include '../session.php';
    
    if (isset($_SESSION['adminID'])) {     
        $sql = "SELECT v.*, u.id AS userID, u.username AS username 
                FROM videos v INNER JOIN channels c ON c.id=v.channel_id 
                INNER JOIN users u ON u.id=c.user_id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $noresults = false;
        }

        $videos = $stmt->fetchAll();

        echo "<table class='results'>"
        . "<tr>"
            . "<th>Picture</th><th>Title</th><th>User</th><th>ID</th><th></th>"
        . "</tr>";

        foreach ($videos as $video) {
            echo 
            "<tr>"
                . "<td>";
                if (isset($video['thumbnail']) && $video['thumbnail'] != "") {
                    echo "<img src='../" . $video['thumbnail'] . "' alt='thumbnail' class='channel-result-thumbnail'>";
                }
                else {
                    echo "<img src='../media/images/no-thumbnail.jpg' alt='thumbnail' class='channel-result-thumbnail'>";
                }
                echo "</td>"
                . "<td>"
                    . $video['title']
                . "</td>"
                . "<td>" . "<a href='channel.php?id=" . $video['userID'] . "'>" . $video['username'] . "</a>" . "</td>"
                . "<td>" . $video['id'] . "</td>"
                . "<td>" . "<a href='video.php?id=" . $video['id'] . "'>" . "<button class='edit'>Edit</button>" . "</a>" . "</td>"
            . "</tr>";
        }
        echo "</table>";
    }
?>
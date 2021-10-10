<?php
    include '../connection.php';

    if (!isset($_SESSION['adminID']))
        include '../session.php';
    
    if (isset($_SESSION['adminID'])) {     
        $sql = "SELECT * FROM users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $noresults = false;
        }

        $users = $stmt->fetchAll();

        echo "<table class='results'>"
        . "<tr>"
            . "<th>Picture</th><th>Username</th><th>Email</th><th>ID</th><th></th>"
        . "</tr>";

        foreach ($users as $user) {
            echo 
            "<tr>"
                . "<td>";
                if (isset($user['profile_picture_url']) && $user['profile_picture_url'] != "") {
                    echo "<img src='../" . $user['profile_picture_url'] . "' alt='pfp' class='channel-result-pfp'>";
                }
                else {
                    echo "<img src='../media/images/default-pfp.jpg' alt='pfp' class='channel-result-pfp'>";
                }
                echo "</td>"
                . "<td>"
                    . $user['username']
                . "</td>"
                . "<td>" . $user['email'] . "</td>"
                . "<td>" . $user['id'] . "</td>"
                . "<td>" . "<a href='channel.php?id=" . $user['id'] . "'>" . "<button class='edit'>Edit</button>" . "</a>" . "</td>"
            . "</tr>";
        }
        echo "</table>";
    }
?>
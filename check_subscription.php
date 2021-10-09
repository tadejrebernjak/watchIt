<?php
    $sql = "SELECT * FROM subscriptions WHERE (channel_id = ?) AND (user_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$channeluser['id'], $_SESSION['userID']]);

    if ($stmt->rowCount() > 0) {
        $subbed = true;
    }
    else {
        $subbed = false;
    }
?>
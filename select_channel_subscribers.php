<?php
    $sql = "SELECT COUNT(*) AS subs FROM subscriptions WHERE channel_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$channel['id']]);

    $result = $stmt->fetch();
    $subs = $result['subs'];

    echo $subs . " subscribers";
?>
<?php 
    
    $userID = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID]);

    $channeluser = $stmt->fetch();

    $sql = "SELECT * FROM channels WHERE user_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID]);

    $channel = $stmt->fetch();

    $views = addView($pdo, $channel['id'], (int)$channel['views']);

    function addView($pdo, $channelID, $views) {
        $views++;

        if (isset($_SESSION['userID'])) {
            $sql = "UPDATE channels SET views=? WHERE (id=?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$views, $channelID]);
        }

        $sql = "SELECT views FROM channels WHERE (id=?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$channelID]);

        $result = $stmt->fetch();
        return $result['views'];
    }

?>
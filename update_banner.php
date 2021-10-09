<?php 
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];

    $target_dir = "media/uploads/images/";
    $prefix_name = date("YmdHis") . $userID;
    $target_file = $target_dir . $prefix_name . basename($_FILES["banner"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["banner"]["size"] > 10000000) {
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        $channelID = getChannelID($userID, $pdo);

        move_uploaded_file($_FILES["banner"]["tmp_name"], 
                $target_file);
        $query = "UPDATE channels SET banner_picture_url=? WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$target_file, $channelID]);

        header("Location: user.php");
    }
    else {
        header("Location: user.php?r=bannererror");
    }

    function getChannelID($userID, $pdo) {
        $sql = "SELECT id FROM channels WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID]);

        $channel = $stmt->fetch();
        $channelID = $channel['id'];

        return $channelID;
    }
?>
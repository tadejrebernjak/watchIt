<?php
    include '../connection.php';

    if (!isset($_SESSION['adminID']))
        include '../session.php';
    
    if (isset($_SESSION['adminID'])) {  
        $userID = $_POST['id'];
        $channelID = getChannelID($userID, $pdo);
        $username = $_POST['username'];
        $email = $_POST['email'];
        $description = $_POST['description'];
        
        $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $userID]);

        $sql = "UPDATE channels SET description = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([nl2br($description), $channelID]);

        if (isset($_FILES["pfp"])) {
            $target_dir = "../media/uploads/images/";
            $prefix_name = date("YmdHis") . $userID;
            $target_file = $target_dir . $prefix_name . basename($_FILES["pfp"]["name"]);
            $url = "media/uploads/images/" . $prefix_name . basename($_FILES["banner"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            if ($_FILES["pfp"]["size"] > 5000000) {
                $uploadOk = 0;
            }
    
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }
    
            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["pfp"]["tmp_name"], 
                        $target_file);
                $query = "UPDATE users SET profile_picture_url=? WHERE id=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$url, $userID]);
            }
            else {
                header("Location: channel.php?id=" . $userID . "&uploaderror=pfp");
            }
        }

        if (isset($_FILES["banner"])) {
            $target_dir = "../media/uploads/images/";
            $prefix_name = date("YmdHis") . $userID;
            $target_file = $target_dir . $prefix_name . basename($_FILES["banner"]["name"]);
            $url = "media/uploads/images/" . $prefix_name . basename($_FILES["banner"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            if ($_FILES["banner"]["size"] > 5000000) {
                $uploadOk = 0;
            }
    
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }
    
            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["banner"]["tmp_name"], 
                        $target_file);
                $query = "UPDATE channels SET banner_picture_url=? WHERE id=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$url, $channelID]);
            }
            else {
                header("Location: channel.php?id=" . $userID . "&uploaderror=banner");
            }
        }

        header("Location: channel.php?id=" . $userID);
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
<?php 
    include 'connection.php';
    include 'session.php';

    $userID = $_SESSION['userID'];
    $title = $_POST['title'];
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    }
    $visibility = $_POST['visibility'];
    $channelID = getChannelID($userID, $pdo);

    $target_dir = "media/uploads/videos/";
    $prefix_name = date("YmdHis") . $userID;
    $target_file = $target_dir . $prefix_name . basename($_FILES["video"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["video"]["size"] > 50000000) {
        $uploadOk = 0;
    }

    if ($imageFileType != "mp4" && $imageFileType != "mov") {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["video"]["tmp_name"], 
                $target_file);
        if (isset($description)) {
            $query = "INSERT INTO videos (video_url, title, description, listed, channel_id) VALUES (?,?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$target_file, $title, nl2br($description), $visibility, $channelID]);
        }
        else {
            $query = "INSERT INTO videos (video_url, title, visibility, channel_id) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$target_file, $title, $visibility, $channelID]);
        }

        if (isset($_FILES["thumbnail"])) {
            $videoID = getVideoID($target_file, $pdo);

            $target_dir = "media/uploads/thumbnails/";
            $prefix_name = date("YmdHis") . $userID;
            $target_file = $target_dir . $prefix_name . basename($_FILES["thumbnail"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($_FILES["thumbnail"]["size"] > 5000000) {
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["thumbnail"]["tmp_name"], 
                        $target_file);
                $query = "UPDATE videos SET thumbnail=? WHERE id=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$target_file, $videoID]);
            }
            else {
                header("Location: edit.php?id=" . $videoID . "&uploaderror=thumbnail");
            }
        }

        header("Location: index.php");
    }
    else {
        header("Location: upload.php?r=videoerror");
    }

    function getChannelID($userID, $pdo) {
        $sql = "SELECT id FROM channels WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID]);

        $channel = $stmt->fetch();
        $channelID = $channel['id'];

        return $channelID;
    }

    function getVideoID($url, $pdo) {
        $sql = "SELECT id FROM videos WHERE video_url=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$url]);

        $video = $stmt->fetch();
        $videoID = $video['id'];

        return $videoID;
    }
?>
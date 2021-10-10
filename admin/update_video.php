<?php
    include '../connection.php';
    include '../session.php';

    $videoID = $_POST['id'];
    $title = $_POST['title'];
    $listed = $_POST['listed'];
    $description = $_POST['description'];

    $query = "UPDATE videos SET title = ?, description = ?, listed = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title, nl2br($description), $listed, $videoID]);

    if (isset($_FILES["thumbnail"])) {
        $target_dir = "../media/uploads/thumbnails/";
        $prefix_name = date("YmdHis") . $userID;
        $target_file = $target_dir . $prefix_name . basename($_FILES["thumbnail"]["name"]);
        $url = "media/uploads/thumbnails/" . $prefix_name . basename($_FILES["thumbnail"]["name"]);
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
            $stmt->execute([$url, $videoID]);
        }
        else {
            header("Location: video.php?id=" . $videoID . "&uploaderror=thumbnail");
        }
    }

    header("Location: video.php?id=" . $videoID);

?>
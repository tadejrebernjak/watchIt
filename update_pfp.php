<?php 
    include 'connection.php';

    $userID = $_POST['userid'];

    $target_dir = "media/uploads/images/";
    $prefix_name = date("YmdHis") . $userID;
    $target_file = $target_dir . $prefix_name . basename($_FILES["pfp"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["pfp"]["size"] > 5000000) {
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["pfp"]["tmp_name"], 
                $target_file);
        $query = "UPDATE users SET profile_picture_url=? WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$target_file, $userID]);

        header("Location: user.php");
    }
    else {
        header("Location: user.php?r=pfperror");
    }


?>
<?php
    $sql = "SELECT * FROM video_comments WHERE video_id=? ORDER BY date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$videoID]);

    $comments = $stmt->fetchAll();

    foreach ($comments as $comment) {
        $sql = "SELECT u.*, c.id AS channelID FROM users u INNER JOIN video_comments vc ON u.id=vc.user_id INNER JOIN channels c ON u.id=c.user_id WHERE vc.id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$comment['id']]);

        $poster = $stmt->fetch();

        $sql = "SELECT * FROM channels WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$poster['id']]);

        $posterChannel = $stmt->fetch();

        $sql = "SELECT COUNT(*) AS likes FROM video_comment_likes WHERE comment_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$comment['id']]);

        $result = $stmt->fetch();
        $likes = $result['likes'];

        if (isset($userID)) {
            $sql = "SELECT * FROM video_comment_likes WHERE comment_id = ? AND user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$comment['id'], $userID]);

            if ($stmt->rowCount() > 0) {
                $liked = true;
            }
            else {
                $liked = false;
            }
        }

        $uploadedTimeDifference = getTimeDifference($comment['date']);

        echo "<div class='comment'>"
        . "<table class='comment-table'>"
            . "<tr>"
                . "<td rowspan='4' class='comment-profile'>"
                . "<a href='channel.php?id=" . $poster['channelID'] . "'>";
                    if (isset($poster['profile_picture_url'])) {
                        echo "<img src='" . $poster['profile_picture_url'] . "' alt='pfp' class='uploader-pfp'>";
                    }
                    else {
                        echo "<img src='media/images/default-pfp.jpg' alt='pfp' class='uploader-pfp'>";
                    }
                echo "</a>" . "<br>"
                . "<a href='channel.php?id=" . $poster['channelID'] . "'>" . $poster['username'] . "</a>" . "<br>"
                . "</td>"
                . "<td class='comment-date'>"
                    . $uploadedTimeDifference;
                    if ($comment['edited'] == 1) {
                        echo " (edited " . date('d/m/Y' , strtotime($comment['edit_date'])) . ")";
                    }
                echo "</td>"
            . "</tr>"
            . "<tr>"
                . "<td id = 'comment-text" . $comment['id'] . "'>" . $comment['comment'] . "</td>"
            . "</tr>"
            . "<tr>"
                . "<td>"
                    . "<div class='comment-like-icon-container' id='comment-like-icon-container" . $comment['id'] . "'>";
                    if (isset($liked)) {
                        if ($liked == true) {
                            echo "<img src='media/images/like-icon-checked.png' class='comment-like-icon' onmouseover='likeCheckedHover(this)' onmouseout='likeCheckedHoverRelease(this)' onclick='likeCommentUncheck(" . $comment['id'] . ")'>";
                        }
                        else {
                            echo "<img src='media/images/like-icon.png' class='comment-like-icon' onmouseover='likeHover(this)' onmouseout='likeHoverRelease(this)' onclick='likeCommentCheck(" . $comment['id'] . ")'>";
                        }
                    }
                    else {
                        echo "<a href='login.php'>"
                            . "<img src='media/images/like-icon.png' class='comment-like-icon' onmouseover='likeHover(this)' onmouseout='likeHoverRelease(this)'>"
                        . "</a>";
                    }
                echo "</div><div class='comment-likes-count' id='comment-likes" . $comment['id'] . "'>" . $likes . "</div>";
                if (isset($userID)) {
                    if ($comment['user_id'] == $userID || $videoID == $userID) {
                        echo "<div class='comment-delete-icon-container'>" 
                                . "<img src='media/images/delete-icon.png' class='comment-delete-icon' alt='delete' onmouseover='deleteHover(this)' onmouseout='deleteHoverRelease(this)' onclick='deleteComment(" . $comment['id'] . ", " . $videoID . ")'>"
                            . "</div>";
                    }
                    if ($comment['user_id'] == $userID) {
                        echo "<div class='comment-edit-icon-container'>" 
                                . "<img src='media/images/edit-icon.png' class='comment-edit-icon' alt='delete' onmouseover='editHover(this)' onmouseout='editHoverRelease(this)' onclick='editCommentShow(" . $comment['id'] . ", " . $videoID . ")'>"
                            . "</div>";
                    }
                }
                    echo "</td>"
            . "</tr>"
            . "<tr>"
                . "<td>" 
                    . "<div class='comment-edit-container' id='comment-edit-container" . $comment['id'] . "'></div>"
                . "</td>"
            . "</tr>"
        . "</table>"
        . "</div>"
        . "<hr class='comment-hr'>";
    }
?>
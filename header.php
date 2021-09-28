<link rel="stylesheet" type="text/css" href="css/header.css">
<div class="header">
    <div class="header-content">
        <div class="logo-container">
            <a href="index.php"><img src="media/images/logo.png" alt="WatchIT"></a>
        </div>
        <div class="account-info">
            <?php 
                if (!isset($_SESSION['userID'])) {
                    echo
                    "<ul>"
                        . "<li><a href='login.php'>Login</a></li>"
                        . "<li><a href='register.php'>Register</a></li>"
                    . "</ul>";
                }
                else {
                    include 'select_user.php';
                    echo
                    "<ul>"
                        . "<li>" . "<a href='upload.php'>" . "<img src='media/images/upload-video-icon.png' class='upload-icon'>" . "</a>"
                        . "<li>" . "<a class='username' href='user.php'>" . $user['username'] . "</a>" . "</li>";

                    if ($user['profile_picture_url'] == "") {
                        echo "<li>" . "<img src='media/images/default-pfp.jpg' alt='pfp' class='header-pfp'>" . "</li>";
                    }
                    else {
                        echo "<li>" . "<img src='" . $user['profile_picture_url'] . "' class='header-pfp'>" . "</li>";
                    }

                    echo
                        "<li><a href='logout.php' class='logout'>Logout</a></li>"
                    . "</ul>";
                }
            ?>
        </div>
    </div>
</div>
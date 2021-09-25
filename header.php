<link rel="stylesheet" type="text/css" href="css/header.css">
<div class="header">
    <div class="header-content">
        <div class="logo-container">
            <!--CHANGE LOGO-->
            <a href="index.php"><h1 class="logo">WatchIt</h1></a>
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

                        . "<li>" . "<a class='username' href='user.php'>" . $user['username'] . "</a>" . "</li>";

                    if ($user['profile_picture_url'] == "") {
                        echo "<li>" . "<img src='media/images/default-pfp.jpg' alt='pfp'>" . "</li>";
                    }
                    else {
                        echo "<li>" . "<img src='" . $user['profile_picture_url'] . "'>" . "</li>";
                    }

                    echo
                        "<li><a href='logout.php' class='logout'>Logout</a></li>"
                    . "</ul>";
                }
            ?>
        </div>
    </div>
</div>
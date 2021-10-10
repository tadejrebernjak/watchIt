<link rel="stylesheet" type="text/css" href="../css/header.css">
<link rel="stylesheet" type="text/css" href="../css/searchbar.css">
<script src="https://kit.fontawesome.com/f7a42c090c.js" crossorigin="anonymous"></script>
<div class="header-container">
    <div class="header">
        <div class="header-content">
            <div class="logo-container">
                <a href="index.php"><img src="../media/images/logo-admin.png" alt="WatchITAdmin"></a>
            </div>
            <!--<div class="search-bar">
                <input type="text" placeholder="Search" id="search-text"></input>
                <button id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>-->
            <?php
                if (isset($_SESSION['adminID'])) {
                    echo "<div class='account-info'>
                        <ul>
                            <li><p>" . $admin['username'] . "</p></li>
                            <li>
                                <a href='logout.php'>
                                    <button class='account-button'><i class='fas fa-sign-out-alt'></i> Sign out</button>
                                </a>
                        </ul>
                    </div>";
                }
            ?>
        </div>
    </div>
</div>
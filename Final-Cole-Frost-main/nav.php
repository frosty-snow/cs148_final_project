<!-- #######################    Main Navigation    ####################### -->
<nav class="nav">
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        print '<form action="logout.php" method="GET" class="logout">';
        print '<input type="submit" class="common-button login-button" value="Logout" name="btnSubmit">';
        print '</form>';
        print '<button type="button" class="common-button profile-button"><a href="./profile.php">My Profile</a></button>';
    } else {
        include_once 'register.php';
        include_once 'login.php';
    }
    ?>

    <ul>
        <li><a href="index.php"><img src="image/logo.png" data-src="image/logo.png" data-hover="image/logo2.png" alt="logo" class="logo"></a></li>
    </ul>
</nav>
<!-- #############################   Ends Main Navigation   ############################## -->
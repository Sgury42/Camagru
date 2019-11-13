<html>
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <link rel="stylesheet" type="text/css" href="webroot/css/base.css?<?php echo time(); ?>"> <!--MUST TAKE OFF THE TIME PART! -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

    </head>
    <body>
        <header>
            <ul id="menu">
                <li class="CamagruTitle"><a href="index.php?action=index">Camagru</a></li>
                <?php if ($_SESSION["usr_name"]) : ?>
                <li class="navOption"><a href="index.php?action=usrPanel">My Account</a></li>
                <li class="navOption"><a href="index.php?action=logout">Logout</a></li>                 <!--find a way to logout usr without reload page if on home page? -->
                <?php else : ?>
                <li class="navOption"><a href="index.php?action=login">Log in</a></li>
                <li class="navOption"><a href="index.php?action=signup">Sign up</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                <li class="navOption"><a href="index.php?action=admin">Admin</a></li>
                <?php endif; ?>
                <li class="funButton"><a href="index.php?action=uploadChoice">Let's have fun !</a></li> <!--Use Js to click and check if user is log else send usr to sign in with a special msg-->
           </ul>
        </header>
        <div id="main">
            <?php if (ft_isset($_GET["msg_alert"])) {
                echo "<div id='alertBox' style='display:block;'><div class='closeDiv' onclick=\"closeAlert('alertBox')\"></div>
                <p>". $_GET["msg_alert"] ."</p></div>";
                // unset($_GET["msg_alert"]);
                }?>
            <div class="content"><?php echo $content ?></div>
        </div>
        <footer>
            <p>©sgury 2019</p>
            <a href="">contact</a>
        </footer>
    <script type="text/javascript" src="./view/home.js"></script>
    <!-- <script type="text/javascript" src="./view/usr/signup.js"></script> -->
    </body>
</html>
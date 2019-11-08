<html>
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <link rel="stylesheet" type="text/css" href="webroot/css/base.css">
    </head>
    <body>
        <header>
            <ul id="menu">
                <li><a href="index.php?action=index">Camagru</a></li>
                <?php if ($_SESSION['USR_NAME']) : ?>
                <li class="button"><a href="index.php?action=usrPanel">My Account</a></li>
                <li class="button"><a href="index.php?acton=logout">Logout</a></li>                 <!--find a way to logout usr without reload page if on home page? -->
                <?php else : ?>
                <li class="button"><a href="index.php?action=login">Login</a></li>
                <li class="button"><a href="index.php?action=signin">Sign In</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['ROLE'] == 'admin') : ?>
                <li class="button"><a href="index.php?action=admin">Admin</a></li>
                <?php endif; ?>
                <li class="button"><a href="index.php?action=customPanel">Let's have fun !</a></li> <!--Use Js to click and check if user is log else send usr to sign in with a special msg-->
           </ul>
        </header>
        <div id="main">
            <div><?php echo $msg_alert ?></div>
            <?php echo $content ?>
        </div>
        <footer>
            <p>©sgury 2019</p>
            <a href="">contact</a>
        </footer>
    </body>
</html>
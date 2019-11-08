<?php ob_start(); ?>
<div>
    <p><?php echo $error_msg ?></p>
    <p>Sign In</p>
    <form method="post" onsubmit="return submitChecker()" action="">
        <p>e-mail address:</p>
        <input type="email" name="email" maxlength="80" required><br />
        <p>Login:</p>
        <input type="text" name="login" maxlength="15" required><br />
        <p>Password:</p>
        <input type="password" name="passwd" minlength="9" maxlength="25" onkeyup="passwdStrength(this.value);" required><span id="passStrgth"></span><br />
        <p>To be strong your password should contain at least:<br />
        one lowercase letter and one uppercase letter,<br />
        one number and one special character [$@!%*#?&].</p>
        <p>Confirm password:</p>
        <input type="password" name="passwd2" minlength="9" maxlength="25" required><br />
        <button type="submit" value="submit">Sign In !</button>
    </form>
</div>
<script type="text/javascript" src="./view/usr/signin.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
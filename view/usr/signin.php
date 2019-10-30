<?php ob_start(); ?>
<div>
    <p><?php echo $error_msg ?>
    <p>Sign In</p>
    <form method="post">
        <p>e-mail address:</p>
        <input type="email" name="email"><br />
        <p>Login:</p>
        <input type="text" name="login" maxlength="15"><br />
        <p>Password:</p>
        <input type="password" name="passwd" maxlength="25"><br />
        <p>Confirm password:</p>
        <input type="password" name="repasswd" maxlength="25"><br />
        <button type="submit">Sign In !</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require_once "view/home.php";
<?php ob_start(); ?>
<div>
    <p><?php echo $msg; unset($msg); ?></p>
    <p><?php echo $error_msg; unset($error_msg);?></p>
    <p>Log In</p>
    <form method="POST">
        <p>Login:</p>
        <input type="text" name="login" required><br />
        <p>Password:</p>
        <input type="password" name="passwd" required>
        <button type="submit" value="submit">Log In !</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require_once "view/home.php";
?>
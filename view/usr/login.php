<?php ob_start(); ?>
<div class="form">
    <p class="title">Log In</p>
    <?php if ($msg) {
        echo "<p>". $msg ."</p>";
        unset($msg); } ?>
    <?php if ($error_msg) {
        echo "<p>". $error_msg . "</p>";
        unset($error_msg); }?>
    <form method="POST">
        <p>Login:</p>
        <input type="text" name="login" required><br />
        <p>Password:</p>
        <input type="password" name="passwd" required><br />
        <button type="submit" value="submit">Log In !</button><br />
        <a onclick="tmpPasswd()" style="text-decoration: underline; cursor: pointer">Forgot Password ?</a>
    </form>
</div>
<?php
$content = ob_get_clean();
require_once "view/home/home.php";
?>
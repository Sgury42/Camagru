<?php ob_start(); ?>
<div class="form">
    <p class="title">Sign Up</p>
    <form method="POST" onsubmit="return submitChecker()" action="">
    <?php if ($msg) {
        echo "<p>". $msg ."</p>";
        unset($msg); } ?>
    <?php if ($error_msg) {
        echo "<p>". $error_msg ."</p>";
        unset($error_msg); }?>
        <p>e-mail address:</p>
        <input type="email" name="email" maxlength="80" required><br />
        <p>Login:</p>
        <input type="text" name="login" maxlength="15" required><br />
        <p>Password:</p>
        <input type="password" id="setPwd" name="passwd" minlength="9" maxlength="25" onkeyup="passwdStrength(this.value);" required><br />
        <p>Confirm password:</p>
        <input type="password" id="matchPwd" name="passwd2" minlength="9" maxlength="25" onkeyup="passwdMatch(document.getElementById('setPwd').value, this.value);" required>
        <p class="advice">Your password must contain at least:<br />
        one lowercase letter and one uppercase letter,<br />
        one number and one special character [$@!%*#?&].</p>
        <button type="submit" value="submit">Sign In !</button>
    </form>
</div>
<script type="text/javascript" src="./view/usr/signup.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
?>
<?php ob_start(); ?>
<div class="centerBox">
    <div class="polaBorder">
        <?php if ($imgShootURL) : ?>
            <img id="toCustomize" src=<?php echo "'". $imgShootURL ."'"?>/>
        <?php elseif ($imgUploadURL) : ?>
            <img id="toCustomize" src=<?php echo "http://localhost:8080/camagru/". $imgUploadURL?> />
        <?php endif ; ?>
    </div>
</div>
<!-- <br /> -->
<!-- <canvas id="canvas"  width="320px" height="240px"></canvas> -->
<!-- <script type="text/javascript" src="./view/picture/shoot.js"></script> -->
<?php
$content = ob_get_clean();
require_once "view/home.php";
?>
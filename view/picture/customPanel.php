<?php ob_start(); ?>
<div class="centerBox">
    <div class="polaBorder">
        <img id="toCustomize" src=<?php echo "http://localhost:8080/camagru/". $_SESSION["usr_upload"]?> style="display: block; width: 500px; height: 500px"/>
    </div>
</div>
<!-- <br /> -->
<!-- <canvas id="canvas"  width="320px" height="240px"></canvas> -->
<!-- <script type="text/javascript" src="./view/picture/shoot.js"></script> -->
<?php
$content = ob_get_clean();
require_once "view/home.php";
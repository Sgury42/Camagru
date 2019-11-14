<?php ob_start(); ?>
<div class="centerBox">
    <div class="polaBorder">
        <video id="video" autoplay></video>
    </div>
    <div class="gradientBorder"><div class="pictureButton" onclick="takePicture()">Take a shoot !</div></div>
    <div class="gradientBorder"><div class="pictureButton" onclick="customePicture()">Customize !</div></div>
</div>
<!-- <br /> -->
<!-- <canvas id="canvas"  width="320px" height="240px"></canvas> -->
<script type="text/javascript" src="./view/picture/shoot.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
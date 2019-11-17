<?php ob_start(); ?>
<div id="topBox">
    <!-- <div class="littlePolaBorder"> -->
        <!-- <canvas id="canvas"></canvas> -->
    <!-- </div> -->
</div><br />
<div class="centerBox">
    <div class="polaBorder">
        <video id="video" autoplay></video>
    </div>
    <div id="takePictureBtn" class="gradientBorder">
        <div class="pictureButton" onclick="takePicture()">Take a shoot !</div>
    </div>
    <div class="gradientBorder"><div class="pictureButton" onclick="customePicture()">Customize !</div></div>
</div>
<script type="text/javascript" src="./view/picture/shoot.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
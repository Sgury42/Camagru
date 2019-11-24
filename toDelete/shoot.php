<?php ob_start(); ?>
<div id="topBox">
</div>
<div class="centerBox">
    <div class="polaBorder">
        <video id="video" autoplay></video>
    </div>
    <div id="takePictureBtn" class="gradientBorder">
        <div class="pictureButton" onclick="takePicture()">Take a shoot !</div>
    </div>
    <!-- <div class="gradientBorder"><button class="pictureButton" type="submit" value="imgURL">Customize !</button></div> -->
</div>
<script type="text/javascript" src="./view/picture/shoot.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
<?php ob_start(); ?>
<div class="centerBox">
    <div id="cameraPrompt">
        <div id="takePicture" onclick="location.href='index.php?action=shoot';">Take a picture !</div>
    </div>
    <div class="gradientBorder"><div class="pictureButton" onclick="uploadPic()">Upload a picture</div></div>
    <!-- <video id="video" style="width: 320px; height: 240px; margin: 10px auto; border: 1px solid red" autoplay></video> -->
    <!-- <canvas id="canvas"  width="320px" height="240px"></canvas> -->
    <!-- <button id="captureButton">Take a picture</button> -->
    <div></div>     <!-- put filters and images for collage -->
</div>
<script type="text/javascript" src="./view/uploadChoice.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
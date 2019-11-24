<?php ob_start(); ?>
<div class="centerBox">
    <div id="cameraPrompt">
        <div id="takePicture" onclick="location.href='index.php?action=shoot';">Take a picture !</div>
    </div>
    <div id="uploadButton" class="gradientBorder">
        <div class="pictureButton" onclick="location.href='index.php?action=upload';">Upload a picture</div>
    </div>
</div>

<!-- <script type="text/javascript" src="./view/picture/uploadChoice.js"></script> -->
<?php
$content = ob_get_clean();
require_once "view/home.php";
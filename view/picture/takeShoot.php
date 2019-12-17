<?php ob_start(); ?>
<script type="text/javascript" src="./view/picture/pictureContent.js"></script>
<script id="activeCam">activeCam();</script>
<div class="polaBorder" id="videoBox">
    <img id="preview" alt="filterPreview">
        <video id="video" autoplay></video>
    </img>
</div>
<div id="takePictureBtn" class="gradientBorder">
    <button id="shootBtn" class="myBtn" type="submit" name="usrShootPicture" onclick="takePicture();">Take a shoot !</button>
</div>

<?php
$pictureContent = ob_get_clean();
require_once "view/picture/customPanel.php";
?>



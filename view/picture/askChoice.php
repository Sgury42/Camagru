<?php ob_start(); ?>
<div id="cameraPrompt">
    <div id="takePicture" onclick="location.href='index.php?action=customPanel&choice=shoot';">Take a picture !</div>
</div>
<div id="uploadButton" class="gradientBorder">
    <div class="pictureButton" onclick="location.href='index.php?action=customPanel&choice=upload';">Upload a picture</div>
</div>

<?php
$pictureContent = ob_get_clean();
require_once "view/picture/customPanel.php";
?>
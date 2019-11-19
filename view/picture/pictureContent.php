<?php ob_start(); ?>
<script type="text/javascript" src="./view/picture/pictureContent.js"></script>
<?php if ($_GET["action"] == "customPanel" && $_GET["choice"] == "shoot") : ?>
    <?php echo "test"; ?>
    <script>activeCam();</script>
<?php endif ; ?>
<?php if ($_GET["action"] == "customPanel" && $_GET["choice"] == "toMake") : ?>
<div id="cameraPrompt">
    <div id="takePicture" onclick="location.href='index.php?action=customPanel&choice=shoot';">Take a picture !</div>
</div>
<div id="uploadButton" class="gradientBorder">
    <div class="pictureButton" onclick="location.href='index.php?action=customPanel&choice=upload';">Upload a picture</div>
</div>
<?php elseif ($_GET["action"] == "customPanel" && $_GET["choice"] == "shoot") : ?>
<div class="polaBorder" id="videoBox">
    <video id="video" autoplay></video>
</div>
<div id="takePictureBtn" class="gradientBorder">
    <div class="pictureButton" onclick="takePicture()">Take a shoot !</div>
</div>
<?php elseif ($uploadedPicture) : ?>
<img id="toCustomize" src=<?php echo "'". $uploadedPicture . "'"?>/>
<?php elseif ($_GET["action"] == "customPanel" && $_GET["choice"] == "upload" && !$_FILES["usr_picture"]) : ?>
<div id="upladImage" class="form">
    <form enctype="multipart/form-data" method="POST">
        <?php if (ft_isset($error_msg)) {
            echo $error_msg ;
        } ?>
        <p>Choose a picture to upload:</p>
        <input name="usr_picture" type="file" />
        <button type="submit" name="upload" value="upload">Let's cusomize it !</button>
    </form>
</div>

<?php elseif ($_GET["action"] == "customPanel" && $_GET["choice"] == toCustomize) : ?>
<div class="polaBorder">
<?php if ($imgShootURL) : ?>
        <img id="toCustomize" src=<?php echo "'". $imgShootURL ."'"?>/>
    <?php elseif ($_POST["usr_picture"]) : ?>
        <img id="toCustomize" src=<?php echo $_POST["usr_picture"]?> />
    <?php endif ; ?>
</div>
<?php endif ; ?>

<?php
$pictureContent = ob_get_clean();
require_once "view/picture/customPanel.php";
?>

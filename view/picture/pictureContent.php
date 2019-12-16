<?php ob_start(); ?>
<script type="text/javascript" src="./view/picture/pictureContent.js"></script>
<?php if ($_GET["action"] == "customPanel" && $_GET["choice"] == "shoot") : ?>
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
    <img id="preview" alt="filterPreview">
        <video id="video" autoplay></video>
    </img>
</div>
<div id="takePictureBtn" class="gradientBorder">
    <!-- <form id="sendUsrPicture" method="POST" onclick="takePicture()"> -->
        <button id="shootBtn" class="myBtn" type="submit" name="usrShootPicture" onclick="takePicture();">Take a shoot !</button>
    <!-- </form> -->
</div>
<?php elseif ($uploadedPicture) : ?>
<div class="polaBorder">
    <img id="preview" alt="filterPreview">
        <canvas class="toCustomize" src=<?php echo "'". $uploadedPicture . "'"?>></canvas>
    </img>
</div>
<?php elseif ($_GET["action"] == "customPanel" && $_GET["choice"] == "upload") : ?>
<div id="uploadImage" class="form">
    <form id="fileUpload" enctype="multipart/form-data">
        <?php if (ft_isset($error_msg)) {
            echo $error_msg ;
        } ?>
        <p>Choose a picture to upload:</p>
        <input id="usr_file" name="usrPicture" type="file" accept="image/jpeg, image/png"/>
        <button id="uploadBtn" type="submit" name="upload" value="upload" >Let's cusomize it !</button>
    </form>
</div>
<?php endif ; ?>

<?php
$pictureContent = ob_get_clean();
require_once "view/picture/customPanel.php";
?>
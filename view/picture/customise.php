<?php ob_start(); ?>
<script type="text/javascript" src="./view/picture/pictureContent.js"></script>
<div class="polaBorder" id="videoBox">
    <img id="preview" alt="fileterPreview" />
        <img id="usrPicture" class="toCustomize" src=<?php echo $uploadedPicture ?> alt="uploadedPicture" />
</div>

<?php 
$pictureContent = ob_get_clean();
require_once "view/picture/customPanel.php";
?>
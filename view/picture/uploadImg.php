<?php ob_start(); ?>
<script type="text/javascript" src="./view/picture/pictureContent.js" ></script>
<div id="uploadImage" class="form">
    <form id="fileUpload" enctype="multipart/form-data" method="POST">
        <?php if (ft_isset($error_msg)) {
            echo $error_msg ;
        } ?>
        <p>Choose a picture to upload:</p>
        <input id="usr_file" name="usrPicture" type="file" accept="image/jpeg, image/png"/>
        <button id="uploadBtn" type="submit" name="upload" value="upload" >Let's cusomize it !</button>
    </form>
</div>

<?php 
$pictureContent = ob_get_clean();
require_once "view/picture/customPanel.php";
?>
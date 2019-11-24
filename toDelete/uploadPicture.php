<!-- <?php ob_start(); ?>
<div class="centerBox">
    <div id="uploadImage" class="form">
        <form enctype="multipart/form-data" method="POST">
            <?php if (ft_isset($error_msg)) {
                echo $error_msg;
            }?>
            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
            <p>Choose a picture to upload:</p>
            <input name="usr_picture" type="file" />
            <button type="submit" name="upload" value="upload">Let's customize it !</button>
        </form>
    </div>
</div>

<!-- <script type="text/javascript" src="./view/picture/uploadChoice.js"></script> -->
<?php
$content = ob_get_clean();
require_once "view/home.php"; -->
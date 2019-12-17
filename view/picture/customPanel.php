<?php ob_start(); ?>
<div id="customPanel">
    <div id="customBox">
        <div id="pictureBox"><?php echo $pictureContent ?></div>
        <?php if ($_GET["choice"] != "toMake" && $_GET["choice"] != "upload") : ?>
        <div id="customOptions">
            <div id="filterBox">
                    <?php $files = glob("webroot/img/filters/*.png", GLOB_BRACE);
                    foreach ($files as $file) : ?>
                    <img class="filter" content-type="image/png" onclick="selectFilter(this);" src=<?php echo $file ?> />
                    <?php endforeach ; ?>
            </div>
            <!-- <form id="filterBtns" method="POST"> -->
            <div id=filterBtns>
                <div class="gradientBorder">
                    <div class="myBtn" onclick="location.href='index.php?action=customPanel&choice=toMake';">start over</div>
                </div>
                <form id="saveForm" method="POST">
                    <div class="gradientBorder">
                            <input id="filterIn" class="hidden" name="filter" />
                            <input id="usrShootIn" class="hidden" name="usrShoot" />
                        <button id="saveBtn" class="myBtn" type="submit" name="save" value="save">save</button>
                    </div>
                </form>
                </div>
            <!-- </form> -->
        </div>
        <?php endif ; ?>
    </div>
    <div id="pictureBank">
        <?php if ($pictureBankImgs) : ?>
            <?php $i = 0 ?>
            <?php foreach ($pictureBankImgs as $picture) : ?>
                <?php $i += 1; ?>
                <div class="littlePolaBorder">
                    <img class="usrImg" src=<?php echo USR_IMG_FOLDER . $picture["img_id"] . ".png"; ?> />
                    <div id="imgInfos">
                        <div id="likes">
                            <img class="icon" src=<?php if ($picture["likes_nb"] == 0) {
                                echo LIKES_ICON_B;
                            } else {
                                echo LIKES_ICON_C;
                            } ?> /><p><?php echo $picture["likes_nb"]; ?></p>
                        </div>
                        <div id="comments">
                            <img class="icon" src=<?php echo COMMENTS_ICON_B; ?> />
                            <p><?php echo $picture["comments_nb"]; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach ; ?>
        <?php endif ; ?>
    </div>
</div>
<script type="text/javascript" src="./view/picture/customPanel.js"></script>
<?php 
$content = ob_get_clean();
require_once "view/home/home.php";
?> 
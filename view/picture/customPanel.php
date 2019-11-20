<?php ob_start(); ?>
<div id="customBox">
    <div id="pictureBox"><?php echo $pictureContent ?></div>
    <?php if ($_GET["choice"] != "toMake") : ?>
    <div id="customOptions">
        <div id="filterBox">
            <form method="POST">
                <?php $files = glob("webroot/img/filters/*.png", GLOB_BRACE);
                foreach ($files as $file) : ?>
                <img class="filter" content-type="image/png" onclick="selectFilter(this);" src=<?php echo $file ?> />
                <button type="submit" name="submitFilter" value=<?php echo $file ?>></button>
                <?php endforeach ; ?>
            </form>
        </div>
        <form id="filterBtns" method="POST">
        <div class="gradientBorder">
                <div class="myBtn" onclick="location.href='index.php?action=customPanel&choice=toMake';">start over</div></div>
            <div class="gradientBorder">
                <button class="myBtn" type="submit" name="save" value="save">save</button></div>
        </form>
    </div>
    <?php endif ; ?>
</div>
<div id="pictureBank">
    <!-- for each usr picture saved in db display picture + infos + buttons publish, unpublish, delete-->
</div>
<script type="text/javascript" src="./view/picture/customPanel.js"></script>
<?php 
$content = ob_get_clean();
require_once "view/home.php";
?> 
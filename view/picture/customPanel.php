<?php ob_start(); ?>
<div id="customBox">
    <div id="pictureBox"><?php echo $pictureContent ?></div>
    <div id="customOptions">
        <div id="filterBox">FILTERS<!-- display all filter in box with a for each --></div>
        <form method="POST">
            <div class="gradientBorder">
                <button class="customize Button" type="submit" name="save" value="save">SAVE</button></div>
            <div class="gradientBorder">
                <button class="customize Button" type="submit" name="startOver" value="startOver">START OVER</button></div>
        </form>
    </div>
</div>
<div id="pictureBank">
    <!-- for each usr picture saved in db display picture + infos + buttons publish, unpublish, delete-->
</div>
<?php 
$content = ob_get_clean();
require_once "view/home.php";
?>
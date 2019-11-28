<?php ob_start(); ?>
<div id="feed">
<?php foreach ($feedImgs as $img) : ?>
    <div class="polaBorder">
        <img class="feedImg" src=<?php echo USR_IMG_FOLDER . $img["img_id"] . ".png"; ?> />
        <form method="POST">
            <div id="imgInfos">
                <input class="hidden" name="imgId" value=<?php echo $img["img_id"] ?> />
                <div id="likes">
                    <button type="submit" name="like" value=<?php if ($img["liked"]) {
                        echo "unlike" ;
                    } else {
                        echo "like";
                    } ?> >
                        <img class="icon" src=<?php if ($img["likes_nb"] == 0) {
                        echo LIKES_ICON_B . " /></button>";
                    } else {
                        echo LIKES_ICON_C ." /></button><p>". $img["likes_nb"] ."</p>";
                    } ?>
                </div>
                <div id="comments">
                    <img class="icon" src=<?php if ($img["comments_nb"] == 0) {
                        echo COMMENTS_ICON_B ." />";
                    } else {
                        echo COMMENTS_ICON_C ." /> <p>". $img["comments_nb"] ."</p>";
                    } ?>
                </div>
            </div>
        </form>
    </div>
<?php endforeach; ?>
</div>
<form id="backAndNext" method="POST">
    <button type="submit" name="move" value="back"><-</button>
    <button type="submit" name="move" value="next">-></button>
</form>
<script type="text/javascript" src="./view/home/feed.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
?>
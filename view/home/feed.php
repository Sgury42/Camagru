<?php ob_start(); ?>
<div id="feed">
<?php foreach ($feedImgs as $img) : ?>
    <div class="polaBorder">
        <img class="feedImg" id=<?php echo $img["img_id"] ?> src=<?php echo USR_IMG_FOLDER . $img["img_id"] . ".png"; ?> />
        <div class="imgInfos">
            <form>
                <div class="infos">
                    <button type="button" name="like" onclick="checkRights('like', this)" value=<?php if ($img["liked"]) {
                        echo "unlike" ;
                    } else {
                        echo "like";
                    } ?> >
                        <img class="icon" src=<?php if ($img["likes_nb"] == 0) {
                        echo LIKES_ICON_B;
                    } else {
                        echo LIKES_ICON_C;
                    } ?> /></button>
                    <p><?php echo $img["likes_nb"] ?></p>
                </div>
            </form>
            <form method="POST">
                <div class="infos">
                    <button type="button" name="comment" onclick="comment(this)" value="newComment">
                    <img class="icon" src=<?php if ($img["comments_nb"] == 0) {
                        echo COMMENTS_ICON_B;
                    } else {
                        echo COMMENTS_ICON_C;
                    } ?> /></button>
                    <p><?php echo $img["comments_nb"] ?></p>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
</div>
<script type="text/javascript" src="./view/home/feed.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home.php";
?>
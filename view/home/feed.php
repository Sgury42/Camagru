<?php ob_start(); ?>
<div id="feed">
<?php foreach ($feedImgs as $img) : ?>
    <div class="polaBorder">
        <img class="feedImg" id=<?php echo $img["img_id"] ?> src=<?php echo USR_IMG_FOLDER . $img["img_id"] . ".png"; ?> />
        <div class="imgInfos">
            <form>
                <div class="infos">
                    <button type="button" name="like" onclick="checkRights('like', this)" value=<?php if ($img["liked"] === "true") {
                        echo "unlike" ;
                    } else {
                        echo "like";
                    } ?> >
                        <img class="icon" src=<?php if ($img["liked"] === "true") {
                        echo LIKES_ICON_C;
                    } else {
                        echo LIKES_ICON_B;
                    } ?> /></button>
                    <p><?php echo $img["likes_nb"] ?></p>
                </div>
            </form>
            <form>
                <div class="infos">
                    <button type="button" name="comment" onclick="checkRights('comment', this)">
                    <img class="icon" src=<?php echo COMMENTS_ICON_B; ?> /></button>
                    <p><?php echo $img["comments_nb"] ?></p>
                </div>
            </form>
        </div>
        <div id="commentBox" style="display: none">
            <div class="closeDiv" onclick="closeDiv(this)" style="opacity: 100%;"></div>
            <div class="commentsDisplay"></div>
            <div class="commentForm">
                <textarea type="text" maxlength="250" name="newComment" ></textarea>
                <button type="button" name="sendComment" onclick="checkRights('newcomment', this)">Send !</button>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<script type="text/javascript" src="./view/home/feed.js"></script>
<?php
$content = ob_get_clean();
require_once "view/home/home.php";
?>
<?php ob_start(); ?>
<div id="usrPanel">
    <div id="usrUpdate">
        <form id="changePwd">
            <p>Update my password :</p>
            <input type="password" name="newPwd" placeholder="new password" required/>
            <input type="password" name="confirmationPwd" placeholder="confirm password" required/>
            <input type="submit" name="submit" value="Change my password !"/>
        </form>
        <form id="changeEmail">
            <p>Update my email :</p>
            <input type="email" name="newEmail" placeholder="new email" minlength="9" maxlength="25" required />
            <input type="submit" name="submit" value="Change my email !" />
        </form>
        <form id="changeLogin">
            <p>Update my login :</p>
            <input type="text" maxlength=15 name="newLogin" placeholder="new login" required />
            <input type="submit" name="submit" value="Change my login !" />
        </form>
        <form id="CommentNotification" method="POST">
            <p>Notifications on comments :</p>
            <?php if ($notifOn == "y") : ?>
            <button type="submit" name="notifications" value="switchOFF" style="background-color: chartreuse;">ON</button>
            <?php elseif ($notifOn == "n") : ?>
            <button type="submit" name="notifications" value="switchON" style="background-color: crimson;">OFF</button>
            <?php endif ; ?>
        </form>
        <form id="removeAccount" method="POST">
            <p>Enter your password to remove your account :</p>
            <input type="password" name="pwdDelAccount" placeholder="password" />
            <input type="submit" name="submit" value="DELETE ACCOUNT" /> 
        </form>
    </div>
    <div id="img_manager">
        <?php if ($pictureBankImgs) : ?>
            <?php $i = 0 ?>
            <?php foreach ($pictureBankImgs as $picture) : ?>
                <?php $i += 1; ?>
                <div class="littlePolaBorder">
                    <img class="usrImg" id=<?php echo $picture["img_id"] ?> src=<?php echo USR_IMG_FOLDER . $picture["img_id"] . ".png"; ?>       onmouseover="showForm(<?php echo $i ?>);" onmouseout="hideForm(<?php echo $i ?>);" />
                    <div class="publishForm" id=<?php echo $i ?> >
                        <?php if ($picture["published"] == 0) : ?>
                            <button onclick="imgManagement(this)">publish</button>
                        <?php else : ?>
                            <button onclick="imgManagement(this)">unpublish</button>
                        <?php endif ; ?>
                        <button onclick="imgManagement(this)">delete</button>
                        </div>
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
    <script type="text/javascript" src="./view/usr/panel.js"></script>
</div>

<?php
$content = ob_get_clean();
require_once "view/home/home.php";
?>
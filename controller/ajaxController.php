<?php
require_once "model/user.php";
require_once "model/database.php";

function scrollDown($index)
{
    $totalImg = dbCount("usr_images", "published", "IS NOT NULL");
    $maxPage = ceil($totalImg / IMG_PER_PAGE);
    if ($index > $maxPage) {
        return ;
    } else {
        $offset = IMG_PER_PAGE * $index;
        $feedImgs = getFeedImgs(IMG_PER_PAGE, $offset);
        $feedImgs = likedImgs($_SESSION["usr_name"], $feedImgs);
        echo json_encode($feedImgs);
    }
}

function checkUsrRights($action)
{
    if (!ft_isset($_SESSION["usr_name"])) {
        echo 0;
    } else {
        echo 1;
    }
    // if (!ft_isset($_SESSION["usr_name"]) && $action == "like" ) {
        // echo 0;
    // }
    // else if (!ft_isset($_SESSION["usr_name"]) && $action == "comment") {
        // echo 0;
    // } else {
        // echo 1;
    // }
}

function likeAction($action, $imgId)
{
    $queryLikesNb = getValue("usr_images", "likes_nb", "img_id", $imgId);
    $queryLikesId = getValue("usr_images", "likes_id", "img_id", $imgId);
    $likesNb = $queryLikesNb[0]["likes_nb"];
    $usrId = getId($_SESSION["usr_name"]);

    if ($queryLikesId) {
        $likesId = unserialize($queryLikesId[0]["likes_id"]);
    }
    if (!$likesId) {
        $likesId = [];
    }
    if ($action == "like" && !in_array($usrId, $likesId)) {
        $likesNb += 1;
        array_push($likesId, $usrId);
    } else if ($action == "unlike" && $likesNb > 0) {
        $likesNb -= 1;
        $pos = array_search($usrId, $likesId);
        unset($likesId[$pos]);
    }
    $likesId = serialize($likesId);
    editData("usr_images", "likes_nb", $likesNb, "img_id", $imgId);
    editData("usr_images", "likes_id", "'". $likesId ."'", "img_id", $imgId);
}

function newCommentAction()
{
    $comment = trim($_POST["comment"]);
    $imgId = $_POST["imgId"];
    $usrId = getId($_SESSION["usr_name"]);
    $commentId = "COM". time();
    $queryCommentNb = getValue("usr_images", "comments_nb", "img_id", $imgId);
    $commentNb = $queryCommentNb[0]["comments_nb"];
    $queryCommentsId = getValue("usr_images", "comments_id", "img_id", $imgId);
    if ($comment && $imgId && $usrId) {
        newCommentToDb($commentId, $comment, $imgId, $usrId);
        $commentNb += 1;
        if ($queryCommentsId[0]["comments_id"]) {
            $commentsId = unserialize($queryCommentsId[0]["comments_id"]);
        } else {
            $commentsId = [];
        }
        array_push($commentsId, $commentId);
        editData("usr_images", "comments_nb", $commentNb, "img_id", $imgId);
        editData("usr_images", "comments_id", serialize($commentsId), "img_id", $imgId);
        $ownerId = getValue("usr_images", "usr_id", "img_id", $imgId);
        $ownerInfo = getValue("users", "*", "id", $ownerId[0]["usr_id"]);
        if ($ownerInfo[0]["notifications"] == "y") {
            if (notificationEmail($_SESSION["usr_name"], $comment, $ownerInfo[0]["login"], $ownerInfo[0]["email"])) {
                echo "email have been sent !";
            }
        }
    }
}

function getCommentsAction()
{
    $imgId = $_GET["imgId"];
    if ($imgId) {
        $comments = getValue("comments", "*", "img_id", $imgId, "ORDER BY `date` DESC");
        foreach ($comments as &$comment) {
            $getAuthorName = getValue("users", "login", "id", $comment["usr_id"]);
            $comment["author_name"] = $getAuthorName[0]["login"];
        }
        echo json_encode($comments);
    }
}

function removeMsgAction()
{
    unset($_SESSION["msg"]);
}

function resendEmailAction()
{
    $email = $_POST["email"];
    if (dataExists("users", "email", $email) && dataExists("users", "role", "unverified")) {
        $login = getValue("users", "login", "email", $email);
        $login = $login[0]["login"];
        signinMail($email, $login);
    }
}
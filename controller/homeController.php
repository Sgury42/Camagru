<?php
require_once "model/database.php";
require_once "model/home.php";

function checkUsrRights($likeTry, $commentTry)
{
    if (!ft_isset($_SESSION["usr_name"]) && $likeTry) {
        $msg_alert = "Hey there ! Please Log in or Sign up to like those amazing pictures !";
        header("Location: index.php?action=index&msg_alert=" . $msg_alert);
    }
    if (!ft_isset($_SESSION["usr_name"]) && $commentTry) {
        $msg_alert = "Hey there ! Please Log in or Sign up to comment those beautiful pictures !";
        header("Location: index.php?action=index&msg_alert=" . $msg_alert);
    }
}

function likeAction($action, $imgId, $usrId)
{
    $queryLikesNb = getValue("usr_images", "likes_nb", "img_id", $imgId);
    $queryLikesId = getValue("usr_images", "likes_id", "img_id", $imgId);
    $likesNb = $queryLikesNb[0]["likes_nb"];

    if ($queryLikesId) {
        $likesId = unserialize($queryLikesId[0]["likes_id"]);
    } else {
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
    editData("usr_images", "likes_nb", $likesNb, "img_id", $imgId);
    editData("usr_images", "likes_id", serialize($likesId), "img_id", $imgId);
}

function homeAction()
{
    print_r($_POST);
    if (ft_isset($_POST["like"]) || ft_isset($_POST["comment"])) {
        checkUsrRights($_POST["like"], $_POST["comment"]);
    }
    $usrId = getId($_SESSION["usr_name"]);
    if ($_POST["like"] && $_POST["imgId"] && $_SESSION["usr_name"]) {
        likeAction($_POST["like"], $_POST["imgId"], $usrId);
    }
    // if ($_POST["comment"] && $_POST["imgId"] && $_SESSION["usr_name"]) {
    //      code to display comment page
    // }
    $feedImgs = getFeedImgs(IMG_PER_PAGE, 0);
    $feedImgs = likedImgs($_SESSION["usr_name"], $feedImgs);
    require_once "view/home/feed.php";
}
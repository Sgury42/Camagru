<?php
require_once "model/database.php";

function checkUsrRights()
{
    if (!ft_isset($_SESSION["usr_name"] && $_POST["like"])) {
        $msg_alert = "Hey there ! Please Log in or Sign up to like those amazing pictures !";
        header("Location: index.php?action=index&msg_alert=" . $msg_alert);
    }
    if (!ft_isset($_SESSION["usr_name"] && $_POST["comment"])) {
        $msg_alert = "Hey there ! Please Log in or Sign up to comment those beautiful pictures !";
        header("Location: index.php?action=index&msg_alert=" . $msg_alert);
    }
}

function likeAction($action, $imgId)
{
    $queryResult = getValue("usr_images", "likes_nb", "img_id", $imgId);
    $likesNb = $queryResult[0]["likes_nb"];
    $likesId = 
    if ($action == "like") {
        $likesNb += 1;
    } else if ($action == "unlike") {
        $likesNb -= 1;
    }
    editData("usr_images", "likes_nb", $newNb, "img_id", $imgId);
}

function homeAction()
{
    checkUsrRights();
    if ($_POST["like"] && $_POST["imgId"] && $_SESSION["usr_name"]) {
        likeAction($_POST["like"], $_POST["imgId"]);
    }
    $feedImgs = getFeedImgs();
    $feedImgs = likedImgs($_SESSION["usr_name"], $feedImgs);
    require_once "view/home/feed.php";
}
<?php

function scrollDown($index)
{
    $totalImg = dbCount("usr_images", "published", "y");
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
    if (!ft_isset($_SESSION["usr_name"]) && $action == "like") {
        // $msg_alert = "Hey there ! Please Log in or Sign up to like those amazing pictures !";
        // header("Location: index.php?action=index&msg_alert=" . $msg_alert);
        echo 0;
    }
    else if (!ft_isset($_SESSION["usr_name"]) && $action == "comment") {
        // $msg_alert = "Hey there ! Please Log in or Sign up to comment those beautiful pictures !";
        // header("Location: index.php?action=index&msg_alert=" . $msg_alert);
        echo 0;
    } else {
        echo 1;
    }
}

function likeAction($action, $imgId)
{
    // checkUsrRights("like");
    $queryLikesNb = getValue("usr_images", "likes_nb", "img_id", $imgId);
    $queryLikesId = getValue("usr_images", "likes_id", "img_id", $imgId);
    $likesNb = $queryLikesNb[0]["likes_nb"];
    $usrId = getId($usrName);

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
    editData("usr_images", "likes_nb", $likesNb, "img_id", $imgId);
    editData("usr_images", "likes_id", serialize($likesId), "img_id", $imgId);
}
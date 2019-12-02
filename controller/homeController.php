<?php
require_once "model/database.php";
require_once "model/home.php";



function homeAction()
{
    // if ($_POST["comment"] && $_POST["imgId"] && $_SESSION["usr_name"]) {
    //      code to display comment page
    // }
    $feedImgs = getFeedImgs(IMG_PER_PAGE, 0);
    $feedImgs = likedImgs($_SESSION["usr_name"], $feedImgs);
    require_once "view/home/feed.php";
}
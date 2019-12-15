<?php
require_once "model/database.php";



function homeAction()
{
    $feedImgs = getFeedImgs(IMG_PER_PAGE, 0);
    $feedImgs = likedImgs($_SESSION["usr_name"], $feedImgs);
    require_once "view/home/feed.php";
    // require_once "view/home/home.php";
}
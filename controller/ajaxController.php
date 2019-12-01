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
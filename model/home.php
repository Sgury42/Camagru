<?php

function pageMove($action, $index) {
    print_r("action = ");
    print_r($action);
    if ($action === 0) {
        $index = $index;
    } else if ($action === "next") {
        $index += 1;
    } elseif ($action === "back") {
        $index -= 1;
    }
    $totalImg = dbCount("usr_images", "published", "y");
    $maxPage = ceil($totalImg / IMG_PER_PAGE);
    print_r("maxPage = ");
    print_r($maxPage);
    print_r("index = ");
    print_r($index);
    if ($index > $maxPage || $index < 0) {
        return false ;
    } else {
        $offset = IMG_PER_PAGE * $pageIndex;
        $feedImgs = getFeedImgs(IMG_PER_PAGE, $offset);
        $feedImgs = likedImgs($_SESSION["usr_name"], $feedImgs);
        $_SESSION["page"] = $index;
        return $feedImgs;
    }
}
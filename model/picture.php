<?php
function processUploadToB64()
{
    // $file_tmp = $fileInfo["tmp_name"];
    // $type = pathinfo($fileInfo["name"], PATHINFO_EXTENSION);
    $data = file_get_contents("./private/tmp/tmp.png");

    $base64 = "data:image/". $type .";base64,". base64_encode($data);

    return $base64;
}

// function convertToPng($usrPicture) {
//     file_put_contents("./private/tmp/png.png", base64_decode($usrPicture));
//     $data = file_get_contents($file_tmp);
//     $base64 = "data:image/png;base64,". base64_encode($data);
//     if (ispng($base64)) {
//         echo "It worked !";
//     } else {
//         echo "it didn't work...";
//     }
// }

function checkImgSize($usrShoot) {
    list($width, $height) = getimagesize($usrShoot);
    $img = imagecreatefrompng($usrShoot);
    if ($width > $height && $width > 500) {
        $newWidth = 500;
        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagepng($tmp, "./private/tmp/tmp.png");
        $base64 = processUploadToB64();
    } else if ($height > $width && $height > 375) {
        $newHeight = 375;
        $newWidth = ($width / $height) * $newHeight;
        $tmp = $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagepng($tmp, "./private/tmp/tmp.png");
        $base64 = processUploadToB64();
    }
    if (file_exists("./private/tmp/tmp.png")) {
        unlink("./private/tmp/tmp.png");
    }
    if ($base64) {
        return $base64;
    } else {
        return $usrShoot;
    }
}

function applyAndSave($filter, $target)
{
    $dest = imagecreatefrompng($target);
    $src = imagecreatefrompng($filter);
    $imgId = time();
    list($width, $height) = getimagesize($target);
    imagecopyresampled($dest, $src, 0, 0, 0, 0, $width, $height, 500, 375);
    imagepng($dest, USR_IMG_FOLDER . $imgId .".png", 0);
    imagedestroy($src);
    imagedestroy($dest);
    $totalImg = getGeneralData("total_img");
    $totalImg = $totalImg[0]["total_img"] + 1;
    updateGeneral("total_img", $totalImg);

    return ($imgId);
}

function ispng($file)
{
    $size = getimagesize($file);
    if ($size["mime"] != "image/png") {
        return false ;
    }
    return true ;
}

function isOwner($imgId, $usr_name)
{
    $usrId = getId($usr_name);
    $imgOwner = getImgOwner($imgId);
    if ($usrId == $imgOwner) {
        return true ;
    }
    return false ;
}

function deleteImg($imgId)
{
    if (isOwner($imgId, $_SESSION["usr_name"])) {
        unlink(USR_IMG_FOLDER.$imgId.".png");
        removeData("usr_images", "img_id", $imgId);
        $totalImg = getGeneralData("total_img");
        $totalImg = $totalImg[0]["total_img"] - 1;
        if ($totalImg >= 0) {
            updateGeneral("total_img", $totalImg);
        }
        //remove comments in comments tab
    }
}

function publishManagement($action, $imgId)
{
    if (isOwner($imgId, $_SESSION["usr_name"])) {
        if ($action == "publish")
        {
            editData("usr_images", "published", "now()", "img_id", $imgId);
        } else if ($action == "unpublish") {
            editData("usr_images", "published", "NULL", "img_id", $imgId);
        }
    }
}

// function pngToB64($folderPath, $imgId)
// {
//     $path = $folderPath . $imgId . ".png";
//     $data = file_get_contents($path);
//     $base64 = "data:image/png;base64,". base64_encode($data);
//     return $base64;
// }

function likedImgs($usrName, $imgs)
{
    $usrId = getId($usrName);
    foreach ($imgs as &$img) {
        $likes = unserialize($img["likes_id"]);
        if ($likes) {
            if (in_array($usrId, $likes)) {
                $img["liked"] = true ;
            } else {
                $img["liked"] = false ;
            }
        }
    }
    // print_r($imgs);
    return $imgs ;
}
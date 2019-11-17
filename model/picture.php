<?php

// function imageResize($imageResourceId, $width, $height)
// {
//     $targetWidth = 500;
//     $targetHeight = 500;

//     $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
//     imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

//     return $targetLayer;
// }

function processUpload($fileInfo)
{
    $file = $fileInfo["tmp_name"];
    $sourceProperties = getimagesize($file);
    $fileNewName = time();
    $folderPath = "./tmp/uploads/";
    $ext = pathinfo($fileInfo["name"], PATHINFO_EXTENSION);
    $imageType = $sourceProperties[2];

    switch ($imageType) {
        case IMAGETYPE_PNG:
            $imageResourceId = imagecreatefrompng($file);
            // $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
            imagepng($targetLayer, $folderPath. $fileNewName. "_thump.". $ext);
            break ;
        case IMAGETYPE_GIF:
            $imageResourceId = imagecreatefromgif($file);
            // $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
            imagegif($targetLayer, $folderPath. $fileNewName. "_thump.". $ext);
            break ;
        case IMAGETYPE_JPEG:
            $imageResourceId = imagecreatefromjpeg($file);
            // $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
            imagejpeg($targetLayer, $folderPath. $fileNewName. "_thump.". $ext);
            break ;
        default:
            $error_msg = "Invalid image, please choose an other one.";
            break ;
    }
    move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
    $_SESSION["usr_upload"] = $folderPath. $fileNewName. ".". $ext;
    if ($error_msg) {
        return $error_msg;
    } else {
        return ;
    }
}
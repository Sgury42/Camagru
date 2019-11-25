<?php
function processUploadToB64($fileInfo)
{
    $file_tmp = $fileInfo["tmp_name"];
    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);

    $base64 = "data:image/". $type .";base64,". base64_encode($data);

    return $base64;
}

function applyAndSave($filter, $target)
{
    $dest = imagecreatefrompng($target);
    $src = imagecreatefrompng($filter);
    $imgId = time();
    imagecopyresampled($dest, $src, 0, 0, 0, 0, 500, 375, 500, 375);
    imagepng($dest, USR_IMG_FOLDER . $imgId .".png", 0);
    imagedestroy($src);
    imagedestroy($dest);
    return ($imgId);
}

function ispng($file)
{
    $size = getimagesize($file);
    if ($size["mime"] != "image/png") {
        return flase ;
    }
    return true ;
}

// function pngToB64($folderPath, $imgId)
// {
//     $path = $folderPath . $imgId . ".png";
//     $data = file_get_contents($path);
//     $base64 = "data:image/png;base64,". base64_encode($data);
//     return $base64;
// }
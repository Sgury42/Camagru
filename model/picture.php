<?php
function processUploadToB64($fileInfo)
{
    $file_tmp = $fileInfo["tmp_name"];
    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);

    $base64 = "data:image/". $type .";base64,". base64_encode($data);

    return $base64;
}

function applyFilter($filter, $target)
{
    $dest = imagecreatefrompng($target);
    echo "<img src=". $target ." />";
    exit ;
    $src = imagecreatefrompng($filter);
    imagecopymerge($dest, $src, 0, 0, 0, 0, 500, 375, 100);

    imagedestroy($src);
    return imagepng($dest, "./Private/usrImgs/".time().".png");
}
<?php
function processUpload($fileInfo)
{
    $file_tmp = $fileInfo["tmp_name"];
    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);

    $base64 = "data:image/". $type .";base64,". base64_encode($data);

    return $base64;
}
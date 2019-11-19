<?php
require_once "model/picture.php";

function checkCustomAccess()
{
    if (!ft_isset($_SESSION["usr_name"])) {
        $msg_alert = "Hey there ! Please Log in or Sign up to custom your own images !";
        header("Location: index.php?action=index&msg_alert=" . $msg_alert);
    }
}

// function uploadChoiceAction()
// {
//     checkCustomAccess();
//     require_once "view/picture/uploadChoice.php";
// }

// function shootAction()
// {
//     checkCustomAccess();
//     if ($_POST["shootToCustom"]) {
//         $_SESSION["usr_shoot"] = $_POST["shootToCustom"];
//         // $_SESSION["usr_shoot"] = str_replace("data:image/png;base64,", "", $_POST["shootToCustom"]);
//         header("Location: index.php?action=customPanel");
//     }
//     require_once "view/picture/shoot.php";
// }

function rm_uploads($path) {
    foreach ($path as $file) {
        unlink($file);
    }
}

function uploadAction()
{
    if ($_FILES["usr_picture"]["error"] == 2) {
        $error_msg = "Oups ! Your picture is too big ! Please choose an other one.";
    }
    else if ($_FILES["usr_picture"]["error"]) {
        $error_msg = "Oups ! Something went wrong, please choose an other amazing picture.";
    }
    else {
        array_map('unlink', glob("tmp/uploads/*"));
        if (!$error_msg = processUpload($_FILES["usr_picture"])) {
            header("Location: index.php?action=customPanel");
        }
    }
     require_once "view/picture/uploadPicture.php";
}

function customAction()
{
    checkCustomAccess();
    echo $_POST . "</br>";
    echo $_FILES;
    if ($_POST["upload"] == "upload" && $_GET["choice"] == "toCustomize" && ft_isset($_FILES)) {
        $uploadedPicture = uploadAction();
        print_r("uploadedPicture = " . $uploadedPicture);
    }
    // if ($_SESSION["usr_shoot"]) {
    //     // header('Content-Type: image/png');
    //     $imgShootURL = $_SESSION["usr_shoot"];
    // } else if ($_SESSION["usr_upload"]) {
    //     $imgUploadURL = $_SESSION["usr_upload"];
    // }
    require_once "view/picture/pictureContent.php";
}
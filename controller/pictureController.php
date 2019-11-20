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

function checkFile()
{
    $allowed_ext = array("jpg", "jpeg", "png", "gif");
    $file_name = $_FILES["usr_picture"]["name"];
    $file_ext = strtolower(end(explode(".", $file_name)));
    $error_msg = "";

    if ($_FILES["usr_picture"]["error"] == 2) {
        $error_msg = "Oups ! Your picture is too big ! Please choose an other one.";
    }
    else if ($_FILES["usr_picture"]["error"]) {
        $error_msg = "Oups ! Something went wrong, please choose an other amazing picture.";
    }
    else if (in_array($file_ext, $allowed_ext) === false) {
        $error_msg = "Extension not allowed, Please choose an other wonderful picture.";
    }
    
    return $error_msg;
}

function customAction()
{
    checkCustomAccess();
    print_r($_POST);
    if ($_POST["upload"] == "upload" && ft_isset($_FILES["usr_picture"])) {
        if ($error_msg = checkFile()) {
            require_once "view/picture/pictureContent.php";
        }
        $uploadedPicture = processUpload($_FILES["usr_picture"]);
    }
    require_once "view/picture/pictureContent.php";
}
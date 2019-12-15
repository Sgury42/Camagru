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

// function rm_uploads($path) {
//     foreach ($path as $file) {
//         unlink($file);
//     }
// }

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
    $usr_id = getId($_SESSION["usr_name"]);
    if ($_POST["upload"] == "upload" && ft_isset($_FILES["usr_picture"])) {
        if ($error_msg = checkFile()) {
            require_once "view/picture/pictureContent.php";
        }
        $uploadedPicture = processUploadToB64($_FILES["usr_picture"]);
    }
    if ($_POST["save"] == "save" && $_POST["filter"] && $_POST["usrShoot"]) {
        if (ispng($_POST["filter"]) && ispng($_POST["usrShoot"])) {
            $imgId = applyAndSave($_POST["filter"], $_POST["usrShoot"]);
            if (!imgToDb(USR_IMG_FOLDER, $imgId, $usr_id)) {
                $error_msg = "Oups something went wrong, please try again !";
                if (USR_IMG_FOLDER.$imgId.".png") {
                    unlink(USR_IMG_FOLDER.$imgId.".png");
                }
            }
            //DELETE IMG FROM TMP FOLDER IF IMG STORED IN DB
        } else {
            $error_msg = "Oups something went wrong, please try again !";
        }
    }
    // if ($_POST["delete"] == "delete" && $_POST["imgId"]) {
    //     deleteImg($_POST["imgId"]);
    // }
    // if ($_POST["publish"] && $_POST["imgId"]) {
    //     publishManagement($_POST["publish"], $_POST["imgId"]);
    // }
    $pictureBankImgs = getUsrImgs($usr_id);
    require_once "view/picture/pictureContent.php";
}
        
function imgManagementAction()
{
    $imgId = $_POST["imgId"];
    $action = $_POST["action"];
    if ($action == "delete") {
        deleteImg($imgId);
    } else {
        publishManagement($action, $imgId);
    }
}
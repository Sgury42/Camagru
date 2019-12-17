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
    $allowed_ext = array("jpg", "jpeg", "png");
    $file_name = $_FILES["usrPicture"]["name"];
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
    if ($_POST["save"] == "save" && $_POST["filter"] && $_POST["usrShoot"]) {
        $usrShoot = checkImgSize($_POST["usrShoot"]);
        if (ispng($_POST["filter"]) && ispng($usrShoot)) {
            $imgId = applyAndSave($_POST["filter"], $usrShoot);
            if (!imgToDb(USR_IMG_FOLDER, $imgId, $usr_id)) {
                $error_msg = "Oups something went wrong, please try again !";
                if (USR_IMG_FOLDER.$imgId.".png") {
                    unlink(USR_IMG_FOLDER.$imgId.".png");
                }
            }
        } else {
            $error_msg = "Oups something went wrong, please try again !";
        }
    }
    
    $pictureBankImgs = getUsrImgs($usr_id);

    if ($_POST["upload"] == "upload" && $_FILES["usrPicture"]) {
        if ($error_msg = checkfile()){
            require_once "view/picture/uploadImg.php";
            //need to display error msg;
        } else {
            imagepng(imagecreatefromstring(file_get_contents($_FILES["usrPicture"]["tmp_name"])), "./private/tmp/tmp.png");
            $uploadedPicture = processUploadToB64();
            if (file_exists("./private/tmp/tmp.png")) {
                unlink("./private/tmp/tmp.png");
            }
            $_GET["choice"] = "uploaded";
            require_once "view/picture/customise.php";
        }
    } else if ($_GET["choice"] == "toMake") {
        require_once "view/picture/askChoice.php";
    } else if ($_GET["choice"] == "upload") {
        require_once "view/picture/uploadImg.php";
    } else if ($_GET["choice"] == "shoot") {
        require_once "view/picture/takeShoot.php";
    } else {
        require_once "view/picture/askChoice.php";
    }
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

function fileUploadAction()
{
    if (!ft_isset($_SESSION["usr_name"])) {
        echo json_encode(array ("error" => "You must be log in to do this action"));
    } else if ($error_msg = checkFile()) {
        echo json_encode( array( "error" => $error_msg));
    } else {
        // echo json_encode($_FILES["usrPicture"]);
        $uploadedPicture = processUploadToB64($_FILES["usrPicture"]);
        echo json_encode( array("usrImg" => $uploadedPicture));
    }
}
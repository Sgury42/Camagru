<?php
session_start();

// ini_set('display_errors', 1);

require_once "core/defines.php";
require_once "core/pdo_connect.php";
require_once "core/router.php";
require_once "model/global.php";
require_once "controller/homeController.php";
require_once "controller/usrController.php";
require_once "controller/pictureController.php";
require_once "controller/ajaxController.php";

// print_r($_SESSION);
// print_r($_POST);
// print_r($_GET);

if ($_GET['action']) {
    if ($_GET['action'] == 'index') {
        homeAction();
    }
    else {
        usrRouter();
        pictureRouter();
        ajaxRouter();
    }
}
else {
    homeAction();
}
?>
<?php
session_start();
// ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(-1);
require_once "core/pdo_connect.php";
require_once "core/router.php";
require_once "model/global.php";
require_once "controller/homeController.php";
require_once "controller/usrController.php";
require_once "controller/pictureController.php";

if ($_GET['action']) {
    if ($_GET['action'] == 'index') {
        homeAction();
    }
    else {
    usrRouter();
    pictureRouter();
    }
}
else {
    homeAction();
}
?>
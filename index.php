<?php
session_start();

// error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
// ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(-1);
require_once "core/defines.php";
require_once "core/pdo_connect.php";
require_once "core/router.php";
require_once "model/global.php";
require_once "controller/homeController.php";
require_once "controller/usrController.php";
require_once "controller/pictureController.php";

print_r($_SESSION);
print_r($_POST);
print_r($_GET);


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
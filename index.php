<?php
session_start();
//require_once
require_once "core/router.php";
require_once "model/global.php";
require_once "controller/homeController.php";
require_once "controller/usrController.php";

if ($_GET['action']) {
    if ($_GET['action'] == 'index') {
        homeAction();
    }
    else {
    usrRouter();
    }
}
else {
    homeAction();
}
?>
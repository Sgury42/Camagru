<?php
session_start();
//require_once
try {
    require_once "core/pdo_connect.php";
    $sql = 'SELECT login, role FROM test
            ORDER BY login';
} catch (Exception $e) {
    $error = $e->getMessage();
}
require_once "core/router.php";
require_once "model/global.php";
require_once "controller/homeController.php";
require_once "controller/usrController.php";

if ($db) {
    echo "Connection successful.";
}
else {
    echo $error;
}


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
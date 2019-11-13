<?php

function uploadChoiceAction()
{
    if (!ft_isset($_SESSION["usr_name"])) {
        $msg_alert = "Hey there ! Please Log in or Sign up to custom your own images !";
        header("Location: index.php?action=index&msg_alert=" . $msg_alert);
    }
    require_once "view/picture/uploadChoice.php";
}

function shootAction()
{
    if (!ft_isset($_SESSION["usr_name"])) {
        $msg_alert = "Hey there ! Please Log in or Sign up to custom your own images !";
        header("Location: index.php?action=index&msg_alert=" . $msg_alert);
    }
    require_once "view/picture/shoot.php";
}
<?php
require_once "model/user.php";
require_once "model/database.php";

function signupAction()
{
    if (ft_isset($_SESSION["usr_name"])) {
        header("Location: index.php?action=index");
    }
    else if (ft_isset($_POST["email"]) && ft_isset($_POST["login"])
            && ft_isset($_POST["passwd"]) && ft_isset($_POST["passwd2"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
             $error_msg = "Please enter a valid email address.";
        }
        else if (!passwdIsSecure($_POST["passwd"])) {
            $error_msg = ("Please choose a secure password.");
        }
        else if (accountExists($_POST["login"], $_POST["email"])) {
            $error_msg = ("Looks like you already have an account !
            <a href=\"index.php?action=login\">try to connect</a>");
        }
        else if (dataExists("users", "email", $_POST["email"])) {
            $error_msg = "An account is already using this e-mail address
            <a href=\"index.php?action=login\">try to connect</a>";
        }
        else if (dataExists("users", "login", $_POST["login"])) {
            $error_msg = "This login is already taken, please choose an other one.";
        }
        else if (!newUsr($_POST["login"], "unverified", $_POST["email"], $_POST["passwd"])) {
            removeUsr($_POST["login"]);
            $error_msg = ("Oups try again !");
        }
        else {
            if (signinMail($_POST["email"], $_POST["login"])) {
                $_SESSION["msg_alert"] = "Your account has been created successfully! <br />
                Please check your mail box to verrify your account. <br />
                Didn't receive your confirmation email? <button onclick='verifyEmail()'> Click here </button>";
                header("Location: index.php?action=index");
            } else {
                $error_msg = "Oups something went wrong, please try again.";
                removeUsr($_POST["login"]);
            }
        }
    }
    require_once "view/usr/signup.php";
}

function loginAction() 
{
    if (ft_isset($_SESSION["usr_name"])) {
        header("Location: index.php?action=index");             //add msg to display?
    }
    else if (ft_isset($_POST["login"]) && ft_isset($_POST["passwd"])) {
        if (logRequest($_POST["login"], $_POST["passwd"])) {
            header("Location: index.php?action=index");         //display msg??
        }
        else {
            $error_msg = "Oups try again !";
        }
    }
    require "view/usr/login.php";
}

function verifyAction()
{
    $msg = "Log In to verify your account";
    $code = $_GET["code"];
    if (ft_isset($_SESSION["usr_name"])) {
        header("Location: index.php?action=index");
    }
    else if (ft_isset($_POST["login"]) && ft_isset($_POST["passwd"])) {
        if (firstLog($_POST["login"], $_POST["passwd"], $code)) {
            header("Location: index.php?action=index");
        }
        else {
            $error_msg = "Oups try again !";
        }
    }
    require "view/usr/login.php";
}

function logoutAction()
{
    $_SESSION["usr_name"] = "";
    $_SESSION["role"] = "";
    array_map('unlink', glob("tmp/uploads/*"));
    header("Location: index.php?action=index");
}
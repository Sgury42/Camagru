<?php
require_once "model/user.php";
// require_once "model/database.php";

function signinAction()
{
    $errors = [];
    if (ft_isset($_SESSION["USR_NAME"])) {
        header("Location: index.php?action=index");
    }
    else if (ft_isset($_POST["email"], $_POST["login"]
        && ft_isset($_POST["passwd"] && ft_isset($_POST["repasswd"])))) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }
        if ($_POST["passwd"] != $_POST["repasswd"]) {
            $errors[] = "Oups ! Passwords don't match!";
        }
        if ($pwdErrors = isPasswdStrong($_POST["passwd"])) {
            $errors = array_merge($errors, $pwdErrors);
        }
        // if (dataExists(DB_USER, $_POST["email"])) {
            // $errors[] = "An account is already using this e-mail address !";             //add a link to receive unique link to reset passwd
        // }
        // if ($dataExists(DB_USER, $_POST["login"])) {
            // $errors[] = "This login is already taken, please choose a new one";
        // }
        else if (!newUsr(DB_USER, $_POST["email"], $_POST["login"], $_POST["passwd"], "user")) {
            $error_msg = ("Oups try again !");
        }
        else {
            return (header("Location: index.php?action=login"));                  // Maybe better to display a message saying that an email has been sent?
        }
    }
    $error_msg = join("<br />", $errors);
    require_once "view/usr/signin.php";
}


// should try to clean this code, look up for :
    //do 
    //try
//or BETTER use javascript to check passwd strength and if password are the same;
<?php

function isPasswdStrong($passwd)
{
    if (strlen($passwd) < 9) {
        $errors[] = "Password must be at least 9 characters long.";
    }
    if (!preg_match("#[0-9]+#", $passwd)) {
        $errors[] = "Password must include at least one number.";
    }
    if (!preg_match("#[A-Z]+#", $passwd)) {
        $errors[] = "Password must include at least one uppercase letter;";
    }
    return ($errors);
}

function newUser($db, $email, $login, $passwd) 
{
}
<?php

function passwdIsSecure($passwd)
{
    $pattern = '/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@!%*#?&])/';
    if (preg_match($pattern, $passwd) && strlen($passwd) >= 9) {
        return true;
    }
    return false;
}

function getId($login)
{
    if ($result = getValue("users", "id", "login", $login)) {
        $id = $result[0]["id"];
        return $id;
    }
    return false;
}

function signinMail($to_email, $login)
{
    $subject = "Welcome to Camagru !";
    $id = getId($login);
    $code = getCode($id);
    $url = "index.php/action=verify&code=" . $code;
    $message = "Hi " . $login . " !\n
        We are happy to have you being part of our comunity! \n
        Please click the link to verrify you account and join the fun !";

}
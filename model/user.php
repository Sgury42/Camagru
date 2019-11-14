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
    $url = "http://localhost:8080/camagru/index.php?action=verify&code=" . $code;
    $message = "
    <html>
        <head>
            <title>Welcome to Camagru !</title>
        </head>
        <body>
        <p>Hi ". $login ." !</p><br />
        <p>We are happy to have you being part of our comunity!</p>
        <p>Please click the link below to verrify your account and join the fun !</p>
        <a href='". $url ."'>---------->JOIN CAMAGRU !<----------</a><br /><br /><br />
        <p>or copy this link into your browser: ". $url ."<br />
        </body>
    </html>";
    $header = "Content-type: text/html; charset='UTF-8'";
    if (mail($to_email, $subject, $message, $header)) {
        return true;
    } else {
        return false;
    }

}

function isVerified($login)
{
    $result = getValue("users", "role", "login", $login);
    $status = $result[0]["role"];
    if (ft_isset($status) && $status != "unverified") {
        return true;
    }
    return false;
}

function logRequest($login, $passwd)
{
    if (isVerified($login) && dataExists("users", "login", $login) && checkPasswd($login, $passwd)) {
        $result = getValue("users", "role", "login", $login);
        $role = $result[0]["role"];
        $_SESSION["usr_name"] = $login;
        $_SESSION["role"] = $role;
        return true;
    }
    return false;
}

function firstLog($login, $passwd, $code) 
{
    if (!isVerified($login) && dataExists("users", "login", $login) && checkPasswd($login, $passwd)) {
        $result = getValue("users", "id", "login", $login);
        $id = $result[0]['id'];
        if (editData("users", "role", "client", "login", $login) && removeData("codes", "usr_id", $id)) {
            $_SESSION["usr_name"] = $login;
            $_SESSION["role"] = "client";
            return true;
        }
    }
    return false;
}
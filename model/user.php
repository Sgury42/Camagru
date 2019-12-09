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

function notificationEmail($fromUsrName, $value, $login, $to_email)
{
    $subject = "Hi ". $login . ", there is something new on your Camagru account !!!";
    $message = "
    <html>
        <head>
            <title>You got a new comment !!</title>
        </head>
        <body>
            <p>How is it going ". $login ." ?</p>
            <p>One of your fabulous picture got a new comment from ". $fromUsrName ." !</p>
            <p>It says: </p>
            <p>". $value ."</p>
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
            $queryResult = getGeneraldata("total_usr");
            $totalUsr = $queryResult[0]["total_usr"];
            $totalUsr += 1;
            updateGeneral("total_usr", $totalUsr);
            $_SESSION["usr_name"] = $login;
            $_SESSION["role"] = "client";
            return true;
        }
    }
    return false;
}
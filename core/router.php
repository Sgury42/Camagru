<?php
function usrRouter()
{
    switch ($_GET["action"]) {
        case "signup":
            signupAction();
            break ;
        case "verify":
            verifyAction();
            break ;
        case "login":
            loginAction();
            break ;
        case "logout":
            logoutAction();
            break ;
    }
    // homeAction();
}

function customRouter()
{
    switch ($_GET["action"]) {
        case "customPanel":
            customAction();
            break ;
    }
}

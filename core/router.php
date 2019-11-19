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

function pictureRouter()
{
    switch ($_GET["action"]) {
        // case "uploadChoice":
        //     uploadChoiceAction();
        //     break ;
        // case "shoot":
        //     shootAction();
        //     break ;
        // case "upload":
        //     uploadAction();
        //     break ;
        case "customPanel":
            customAction();
            break ;
    }
}

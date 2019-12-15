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
        case "usrPanel":
            usrPanelAction();
            break ;
        case "usrUpdate":
            usrUpdateAction();
            break ;
    }
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
        case "imgManagement":
            imgManagementAction();
            break ;
    }
}

function ajaxRouter()
{
    switch ($_GET["action"]) {
        case "scrollDown":
            scrollDown($_GET["index"]);
            break ;
        case "like":
            likeAction($_POST["action"], $_POST["imgId"]);
            break ;
        case "checkUsrRights":
            checkUsrRights($_GET["request"]);
            break ;
        case "newcomment":
            newCommentAction();
            break ;
        case "getComments":
            getCommentsAction();
            break ;
        case "removeMsg":
            removeMsgAction();
            break ;
        case "verifyEmail":
            resendEmailAction();
            break ;

    }
}
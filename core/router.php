<?php
function usrRouter()
{
    switch ($_GET["action"]) {
        case "signin":
            signinAction();
            break ;
    }
    homeAction();
}
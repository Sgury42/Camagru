<?php
require_once "controller/ajaxController.php";

return "test";

function ajaxRouter()
{
    return "test";
    switch ($_POST["ajaxAction"]) {
        case "scrollDown":
            return "test";
            // scrollDown($_POST["index"]);
            break ;
    }
}
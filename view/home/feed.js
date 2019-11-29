window.onload = function() {
    window.onscroll = scrollFunction;
}
var index = 0;

function scrollFunction() 
{
    console.log("test");
    index += 1;
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "core/ajaxRouter.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4) {
            console.log("ajax done ! status = " + xmlhttp.status);
            if (xmlhttp.status === 200) {
                console.log("return = " + xmlhttp.responseText);
            }
        } else {
            console.log("ERROR = " + xmlhttp.status);
        }
    }
    xmlhttp.send("ajaxAction=scrollDown&index=" + index);
}
function verifyEmail()
{
    var email = prompt("Please enter your email:");
    if (email !== null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "index.php?action=verifyEmail", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                //nothing?
                if (xmlhttp.status === 200) {
                    console.log(xmlhttp.responseText);
                }
            } else {
               console.log("readyState = " + xmlhttp.readyState);
               console.log("ERROR = " + xmlhttp.status);
            }
        }
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("email=" + email);
    }
}

function closeAlert(id)
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "index.php?action=removeMsg", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                var toremove = document.getElementById(id);
                toremove.parentNode.removeChild(toremove);
                if (xmlhttp.status === 200) {
                    console.log(xmlhttp.responseText);
                }
            } else {
               console.log("readyState = " + xmlhttp.readyState);
               console.log("ERROR = " + xmlhttp.status);
            }
        }
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
}
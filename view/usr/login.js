function tmpPasswd() {
    var email = prompt("Please enter your email:");
    if (email !== null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "index.php?action=tmpPasswd", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                alert(xmlhttp.responseText);
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
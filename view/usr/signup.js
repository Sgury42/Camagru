var pwdStrength = "weak";
function submitChecker() {
    var email = document.querySelector('[name="email"').value;
    var login = document.querySelector('[name="login"').value;
    var passwd = document.querySelector('[name="passwd"').value;
    var passwd2 = document.querySelector('[name="passwd2"').value;
    if (!email || !login || !passwd || !passwd2) {
        alert ("Please fill up all fields.");
    }
    else if (passwd != passwd2) {
        alert ("Passwords did not match: Please try again !");
    }
    else if (pwdStrength != "strong") {
        alert ("Please choose a strong password.");
    }
    else {
        return true;
    }
    return false;
}
function passwdStrength(passwd) {
    if (passwd.length === 0) {
        document.getElementById("setPwd").style.border = "none";
        return ;
    }
    var matchedCase = new Array();
    matchedCase.push("[$@!%*#?&]");
    matchedCase.push("[A-Z]");
    matchedCase.push("[0-9]");
    matchedCase.push("[a-z]");

    var control = 0;
    for (var i = 0; i < matchedCase.length; i++) {
        if (new RegExp(matchedCase[i]).test(passwd)) {
            control ++;
        }
    }
    var color = "";
    switch (control) {
        case 0:
        case 1:
        case 2:
            color = "#c80815"; //red
            break;
        case 3:
            color = "orange";
            break;
        case 4:
            if (passwd.length > 8) {
            color = "#bfff00"; //green
            pwdStrength = "strong";
            } else {
            color = "orange";
            break;
            }
        break;
    }
    document.getElementById("setPwd").style.border = "2px solid " + color;
}

function passwdMatch(toMatch, passwd2) {
    if (passwd2.length === 0) {
        document.getElementById("matchPwd").style.border = "none";
        return ;
    }
    var color = "";
    if (toMatch != passwd2) {
        color = "#c80815"; //red
    } else {
        color = "#bfff00"; //green
    }
    document.getElementById("matchPwd").style.border = "2px solid " + color;
}
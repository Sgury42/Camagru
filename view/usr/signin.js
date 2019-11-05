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
    else if (document.getElementById("passStrgth").innerHTML != "Strong") {
        alert ("Please choose a strong password.");
    }
    else {
        return true;
    }
    return false;
}
function passwdStrength(passwd) {
    if (passwd.length === 0) {
        document.getElementById("passStrgth").innerHTML = "";
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
    var strength = "";
    switch (control) {
        case 0:
        case 1:
        case 2:
            strength = "Weak";
            color = "red";
            break;
        case 3:
            strength = "Medium";
            color = "orange";
            break;
        case 4:
            if (passwd.length > 8) {
            strength = "Strong";
            color = "green";
            } else {
            strength = "Medium";
            color = "orange";
            break;
            }
        break;
    }
    document.getElementById("passStrgth").innerHTML = strength;
    document.getElementById("passStrgth").style.color = color;
}
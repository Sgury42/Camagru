window.addEventListener("load", function() {
    function sendData(element) {
        var alertBox = document.getElementById("alertBox");
        console.log(alertBox);
        if (alertBox) {
            closeAlert("alertBox");
        }
        var xmlhttp = new XMLHttpRequest();
        var FD = new FormData(element);
        xmlhttp.addEventListener("load", function() {
            var response = xmlhttp.responseText;
            displayResponse(response);
        });
        xmlhttp.addEventListener("error", function() {
            alert("oups an error occured !");
        });
        xmlhttp.open("POST", "index.php?action=usrUpdate");
        xmlhttp.send(FD);
    }

    var pwdUpdate = document.getElementById("changePwd");
    pwdUpdate.addEventListener("submit", function(event) {
        event.preventDefault();
        sendData(event.target);
    });
    var emailUpdate = document.getElementById("changeEmail");
    emailUpdate.addEventListener("submit", function(event) {
        event.preventDefault();
        sendData(event.target);
    });
    var loginUpdate = document.getElementById("changeLogin");
    loginUpdate.addEventListener("submit", function() {
        event.preventDefault();
        sendData(event.target);
    });

});

function displayResponse(response)
{
    var alertBox = document.createElement("DIV");
    alertBox.setAttribute("id", "alertBox");
    var mainBox = document.getElementById("main");
    mainBox.prepend(alertBox);
    closeBtn = document.createElement("DIV");
    closeBtn.setAttribute("class", "closeDiv");
    closeBtn.setAttribute("onclick", "closeAlert('alertBox')");
    alertBox.appendChild(closeBtn);
    var msg = document.createElement("P");
    msg.textContent = response;
    alertBox.appendChild(msg);
}

function showForm(id)
{
    document.getElementById(id).style.display = "flex";
}
function hideForm(id)
{
    document.getElementById(id).style.display = "none";
}

function imgManagement(element)
{
    var action = element.textContent;
    if (action == "delete" || action == "unpublish"
            || action == "publish") {
        var xmlhttp = new XMLHttpRequest();
        var imgId = element.parentNode.previousElementSibling.id;
        xmlhttp.open("POST", "index.php?action=imgManagement", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                if (action == "delete") {
                    var toDelete = element.parentNode.parentNode;
                    toDelete.remove();
                } else if (action == "publish") {
                    element.textContent = "unpublish";
                } else if (action == "unpublish") {
                    element.textContent = "publish";
                }
                if (xmlhttp.status === 200) {
                    console.log(xmlhttp.responseText);
                }
            } else {
               console.log("readyState = " + xmlhttp.readyState);
               console.log("ERROR = " + xmlhttp.status);
            }
        }
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("action=" + action + "&imgId=" + imgId);
    }
}
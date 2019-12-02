window.onload = function() {
    window.onscroll = scrollFunction;
}
var index = 0;
var path = "./private/usrImgs/";
var tolikeIcon = "./webroot/img/icons/heart_icon.png";
var likedIcon = "./webroot/img/icons/heart_colored_icon.png";

function scrollFunction() 
{
    var element = document.body;
    if (element.scrollHeight - element.scrollTop === element.clientHeight) {
        // alert("bottom !");
        index += 1;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "index.php?action=scrollDown&index=" + index, true);
        // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4) {
                if (xmlhttp.responseText) {
                    console.log("ajax done ! status = " + xmlhttp.status);
                    var imgs = JSON.parse(xmlhttp.responseText);
                    displayImgs(imgs);
                }
                if (xmlhttp.status === 200) {
                    console.log(xmlhttp.responseText);
                }
            } else {
                console.log("readyState = " + xmlhttp.readyState);
                console.log("ERROR = " + xmlhttp.status);
            }
        }
        xmlhttp.send();
    }
}

function doAction(action, element) {
    if (action == "like") {
        likeFunction(element);
    }
}

function checkRights(action, element)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "index.php?action=checkUsrRights&request=" + action, true);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.responseText) {
                console.log("ajax done! status = " + xmlhttp.status);
                 var rights = xmlhttp.responseText;
                 if (rights == 1) {
                     doAction(action, element);
                 } else {
                    return ;
                    //CREATE A DIV DISPLAYING HAVE TO LOG IN TO LIKE IMG OR COMMENT 
                    //CREATE A NEW FUNCTION SO CAN BE REUSED :)
                 }
            } if (xmlhttp.status === 200) {
                console.log(xmlhttp.responseText);
            }
        } else {
            console.log("readyState = " + xmlhttp.readyState);
            console.log("ERROR = " + xmlhttp.status);
        }
    }
    xmlhttp.send();
}

function likeFunction(element)
{
    console.log(element);
    var action = element.value;
    var parent = element.parentNode.parentNode.parentNode;
    var imgId = parent.previousElementSibling.id;
    var icon = element.firstElementChild;
    var likesCountEl = element.nextElementSibling;
    var likesCountNb = likesCountEl.textContent;

    if (action && imgId) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "index.php?action=like", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                if (action == "like") {
                    element.setAttribute("value", "unlike");
                    icon.setAttribute("src", likedIcon);
                    likesCountNb++;
                    likesCountEl.textContent = likesCountNb;
                } else {
                    element.setAttribute("value", "like");
                    icon.setAttribute("src", tolikeIcon);
                    likesCountNb -= 1;
                    likesCountEl.textContent = likesCountNb;
                } if (xmlhttp.status === 200) {
                    // console.log(xmlhttp.responseText);
                }
            } //else {
            //    console.log("readyState = " + xmlhttp.readyState);
            //    console.log("ERROR = " + xmlhttp.status);
            //}
        }
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("action=" + action + "&imgId=" + imgId);
    }
}

function comment(element) {
    console.log(element);
}

function displayImgs(imgs)
{
    imgs.forEach(element => {
        var imgPath = path + element["img_id"] + ".png";
        var feed = document.getElementById("feed");
        var polaBorder = document.createElement("DIV");
        polaBorder.setAttribute("class","polaBorder");
        var img = document.createElement("IMG");
        img.setAttribute("class", "feedImg");
        img.setAttribute("src", imgPath);
        img.setAttribute("id", element["img_id"]);
        polaBorder.appendChild(img);
        // CREATE FORM FOR LIKES AND COMMENTS
        var imgInfos = document.createElement("DIV");
        imgInfos.setAttribute("class", "imgInfos");
        polaBorder.appendChild(imgInfos);
        var likeForm = document.createElement("FORM");
        imgInfos.appendChild(likeForm);
        var likeInfos = document.createElement("DIV");
        likeInfos.setAttribute("class", "infos");
        likeForm.appendChild(likeInfos);
        var likeBtn = document.createElement("BUTTON");
        likeBtn.setAttribute("type", "button");
        likeBtn.setAttribute("name", "like");
        likeBtn.setAttribute("onclick", "likeFunction('like', this)");
        if (element["liked"]) {
            likeBtn.setAttribute("value", "unlike");
        } else {
            likeBtn.setAttribute("value", "like");
        }
        likeInfos.appendChild(likeBtn);
        var icon = document.createElement("IMG");
        icon.setAttribute("class", "icon");
        if (element["likes_nb"] == 0) {
            icon.setAttribute("src", tolikeIcon);
        } else {
            icon.setAttribute("src", likedIcon);
        }
        likeBtn.appendChild(icon);
        var likeNb = document.createElement("P");
        likeNb.textContent = element["likes_nb"];
        likeInfos.appendChild(likeNb);
        //add comment form;

        feed.appendChild(polaBorder);
    });
}
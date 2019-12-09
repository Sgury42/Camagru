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
    } else if (action == "comment") {
        commentFunction(element);
    } else if (action == "newcomment") {
        newComment(element);
    }
}

function alertMsg(action)
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
    msg.textContent = "Please Log In or Sign Up to " + action + " those beautiful images !";
    alertBox.appendChild(msg);
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
                     alertMsg(action);
                    return ;
                 }
            } if (xmlhttp.status === 200) {
                // console.log(xmlhttp.responseText);
            }
        } else {
            // console.log("readyState = " + xmlhttp.readyState);
            // console.log("ERROR = " + xmlhttp.status);
        }
    }
    xmlhttp.send();
}

function likeFunction(element)
{
    // console.log(element);
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
                    console.log(xmlhttp.responseText);
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

function closeDiv(element)
{
    var parent = element.parentNode;
    parent.style.display = "none";
}

function commentFunction(element) {
    var commentsDisplay = element.parentNode.parentNode.parentNode.nextElementSibling.firstElementChild.nextElementSibling;
    var imgId = element.parentNode.parentNode.parentNode.parentNode.firstElementChild.id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "index.php?action=getComments&imgId="+ imgId, true);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.responseText) {
                console.log("ajax done! status = " + xmlhttp.status);
                var comments = JSON.parse(xmlhttp.responseText);
                console.log(comments);
                displayComments(commentsDisplay, comments);
                } if (xmlhttp.status === 200) {
                // console.log(xmlhttp.responseText);
            }
        } else {
            // console.log("readyState = " + xmlhttp.readyState);
            // console.log("ERROR = " + xmlhttp.status);
        }
    }
    xmlhttp.send();


    var commentBox = element.parentNode.parentNode.parentNode.nextElementSibling;
    commentBox.style.display = "flex";
}

function removeComment(element) {
    // close div function + send POST ajax to remove comment from db
}

function newComment(element, img_id) {
    //get the text and img id
    var comment = element.previousElementSibling.value;
    var img_id = element.parentNode.parentNode.parentNode.firstElementChild.id;
    //send POST request with ajax to put new comment in db
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "index.php?action=newcomment", true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            console.log("ajax done ! readyState = "+ xmlhttp.readyState);
            //display comment on the list
            if (xmlhttp.status === 200) {
                console.log(xmlhttp.responseText);
            }
        } else {
            console.log("readyState = " + xmlhttp.readyState);
            console.log("ERROR = " + xmlhttp.status);
        }
    }
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("comment=" + comment + "&imgId=" + img_id);
    //remove text from textarea 
    element.previousElementSibling.value = "";
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

function displayComments(commentsDisplay, comments)
{
    comments.forEach(element => {
        var comment = document.createElement("DIV");
        comment.setAttribute("class", "singleComment");
        var commentInfo = document.createElement("DIV");
        commentInfo.setAttribute("class", "commentInfo");
        var author = document.createElement("DIV");
        author.setAttribute("class", "commentAuthor");
        author.textContent = element["author_name"];
        var date = document.createElement("DIV");
        date.setAttribute("class", "commentDate");
        date.textContent = element["date"];
        commentInfo.appendChild(author);
        commentInfo.appendChild(date);
        comment.appendChild(commentInfo);
        var text = document.createElement("DIV");
        text.textContent = element["text"];
        comment.appendChild(text);
        commentsDisplay.appendChild(comment);
    });
}
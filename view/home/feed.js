window.onload = function() {
    window.onscroll = scrollFunction;
}
var index = 0;
var path = "./private/usrImgs/";
var tolikeIcon = "./webroot/img/icons/heart_icon.png";
var likedIcon = "./webroot/img/icons/heart_colored_icon.png";
var commentIcon = "./webroot/img/icons/comment_icon.png";

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
                while (commentsDisplay.firstChild) {
                    commentsDisplay.removeChild(commentsDisplay.firstChild);
                }
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
    var xmlhttp = new XMLHttpRequest();
    if (element.previousElementSibling.value.trim()) {
        xmlhttp.open("POST", "index.php?action=newcomment", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                console.log("ajax done ! readyState = "+ xmlhttp.readyState);
                var displayComments = element.parentNode.previousElementSibling;
                var chargeComBtn = element.parentNode.parentNode.previousElementSibling.firstElementChild.nextElementSibling.firstElementChild.firstElementChild;
                var commentNbNode = element.parentNode.parentNode.previousElementSibling.firstElementChild.nextElementSibling.firstElementChild.firstElementChild.nextElementSibling;
                var commentNb = commentNbNode.textContent;
                commentNb++;
                commentNbNode.textContent = commentNb;
                console.log(commentNb);
                // console.log(displayComments);
                while (displayComments.firstChild) {
                    displayComments.removeChild(displayComments.firstChild);
                }
                commentFunction(chargeComBtn);
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
}
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
        likeBtn.setAttribute("onclick", "checkRights('like', this)");
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
        var commentForm = document.createElement("FORM");
        imgInfos.appendChild(commentForm);
        var commentInfos = document.createElement("DIV");
        commentInfos.setAttribute("class", "infos");
        commentForm.appendChild(commentInfos);
        var commentBtn = document.createElement("BUTTON");
        commentBtn.setAttribute("type", "button");
        commentBtn.setAttribute("name", "comment");
        commentBtn.setAttribute("onclick", "checkRights('comment', this)");
        var comIcon = document.createElement("IMG");
        comIcon.setAttribute("class", "icon");
        comIcon.setAttribute("src", commentIcon);
        commentBtn.appendChild(comIcon);
        commentInfos.appendChild(commentBtn);
        var comNb = document.createElement("P");
        comNb.textContent = element["comments_nb"];
        commentInfos.appendChild(comNb);
        var commentBox = document.createElement("DIV");
        commentBox.setAttribute("id", "commentBox");
        commentBox.setAttribute("style", "display: none");
        polaBorder.appendChild(commentBox);
        var closeDiv = document.createElement("DIV");
        closeDiv.setAttribute("class", "closeDiv");
        closeDiv.setAttribute("onclick", "closeDiv(this)");
        closeDiv.setAttribute("style", "opacity: 100%");
        commentBox.appendChild(closeDiv);
        var commentDisplay = document.createElement("DIV");
        commentDisplay.setAttribute("class", "commentsDisplay");
        commentBox.appendChild(commentDisplay);
        var commentForm = document.createElement("DIV");
        commentForm.setAttribute("class", "commentForm");
        commentBox.appendChild(commentForm);
        var textarea = document.createElement("TEXTAREA");
        textarea.setAttribute("type", "text");
        textarea.setAttribute("maxlength", "250");
        textarea.setAttribute("name", "newComment");
        commentForm.appendChild(textarea);
        var subBtn = document.createElement("BUTTON");
        subBtn.setAttribute("type", "button");
        subBtn.setAttribute("name", "sendComment");
        subBtn.setAttribute("onclick", "checkRights('newcomment', this)");
        subBtn.textContent = "Send !";
        commentForm.appendChild(subBtn);

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
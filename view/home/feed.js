window.onload = function() {
    window.onscroll = scrollFunction;
}
var index = 0;
var path = "./private/usrImgs/";

function scrollFunction() 
{
    var element = document.body;
    if (element.scrollHeight - element.scrollTop === element.clientHeight) {
        // alert("bottom !");
        index += 1;
        console.log(index);
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
        // CREATE FORM FOR LIKES AND COMMENTS
        polaBorder.appendChild(img);
        feed.appendChild(polaBorder);
    });
}

function likeFunction(element)
{
    console.log(element);
}

function comment(element) {
    console.log(element);
}
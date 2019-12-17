navigator.getUserMedia = navigator.getUserMedia
    || navigator.webkitGetUserMedia
    || navigator.mozGetUserMedia
    || navigator.msGetUserMedia;

window.URL = window.URL
    || window.webkitURL;

// var canvas, video;

function activeCam() {

    navigator.getUserMedia({ video: true }, function (localMediaStream) {
        video = document.querySelector('video');
        window.stream = localMediaStream;
        try {
            video.srcObject = localMediaStream;
        } catch (error) {
            video.src = window.URL.createObjectURL(localMediaStream);
        }
    }, function (error) {
        document.querySelector('#video').style.display = 'none';
    });

    // function enableButton() {
    // var btn = document.getElementById('button');
    // console.log(btn);
    // btn.removeAttribute('disabled');
    // }

    // function previewFilter(radio) {
    // document.querySelector('#video_preview').src = 'public/filters/'+radio.value;
    // document.querySelector('#snapshot_preview').src = 'public/filters/'+radio.value;
    // document.getElementById('button').removeAttribute('disabled');
    // }
}


function takePicture() {
    // var frame = document.createElement("DIV");
    // frame.setAttribute("class", "PolaBorder");

    var myCanvas = document.createElement("CANVAS");
    myCanvas.setAttribute("class", "toCustomize");
    myCanvas.setAttribute("width", 500);
    myCanvas.setAttribute("height", 375);

    var form = document.createElement("FORM");
    form.setAttribute("method", "POST");

    var newShootBtn = document.createElement("BUTTON");
    newShootBtn.setAttribute("class", "myBtn");
    newShootBtn.setAttribute("type", "submit");
    newShootBtn.setAttribute("name", "newShoot");
    newShootBtn.innerHTML = "Take a new picture !";

    var btnBorder = document.createElement("DIV");
    btnBorder.setAttribute("class", "gradientBorder");

    var ctx = myCanvas.getContext('2d');
    ctx.drawImage(video, 0, 0, myCanvas.width, myCanvas.height);
    imageDataURL = myCanvas.toDataURL("image/png");

    // document.getElementById("shootBtn").setAttribute("value", imageDataURL);
    btnBorder.appendChild(newShootBtn);
    form.appendChild(btnBorder);
    document.getElementById("videoBox").appendChild(myCanvas);
    document.getElementById("pictureBox").appendChild(form);
    // document.getElementById("videoBox").appendChild(form);
    // document.getElementById("videoBox").appendChild(frame);


    var videoDisplay = document.getElementById("video");
    videoDisplay.parentElement.removeChild(videoDisplay);

    var takePictureBtn = document.getElementById("takePictureBtn");
    takePictureBtn.parentElement.removeChild(takePictureBtn);

    var saveBtn = document.getElementById("saveBtn");
    saveBtn.disabled = false;
    var usrShootIn = document.getElementById("usrShootIn");
    usrShootIn.setAttribute("value", imageDataURL);

    // document.getElementById("sendUsrPicture").submit();



    // console.log("imageDataURL = " + imageDataURL);

    // document.getElementById('snapshot_div').style.display = 'block';
    // document.getElementById('snapshot_img').src = imageDataURL;
    // document.getElementById('snapshot_input').value = imageDataURL;
    // document.getElementById('img_form').style.display = 'none';
}

/*
window.addEventListener("load", function() {
    function sendFile(element) {
        var xmlhttp = new XMLHttpRequest();
        var FD = new FormData(element);
        xmlhttp.addEventListener("load", function() {
            // console.log(JSON.parse(xmlhttp.responseText));
            var responseArray = JSON.parse(xmlhttp.responseText);
            if (responseArray["error"]) {
                alert(responseArray["error"])
            } else if (responseArray["usrImg"]) {
                // console.log(responseArray["usrImg"]);
                displayUsrImg(responseArray["usrImg"]);
            }
        });
        xmlhttp.addEventListener("error", function() {
            alert(xmlhttp.responseText(error));
        });
        xmlhttp.open("POST", "index.php?action=fileUpload");
        xmlhttp.send(FD);
    }

    if (document.getElementById("fileUpload")) {
        var fileUpload = document.getElementById("fileUpload");
        fileUpload.addEventListener("submit", function(event) {
            event.preventDefault();
            var file = document.getElementById("usr_file").files[0];
            var mime_types = [ 'image/jpeg', 'image/png' ];
            if (mime_types.indexOf(file.type) == -1) {
                alert('Error : Incorrect file type');
                return ;
            } else if(file.size > 2*1024*1024) {
                alert('Error : Exceeded size 2MB');
                return ;
            }
            sendFile(event.target);
        });
    }
}); */
/*
function displayUsrImg(usrImg)
{
    var polaBorder = document.createElement("DIV");
    polaBorder.setAttribute("class", "polaBorder");
    polaBorder.setAttribute("id", "videoBox");
    var pictureBox = document.getElementById("pictureBox");
    pictureBox.appendChild(polaBorder);
    var previewFilter = document.createElement("IMG");
    previewFilter.setAttribute("id", "preview");
    previewFilter.setAttribute("alt", "filterPreview");
    previewFilter.setAttribute("style", "display: none");
    polaBorder.appendChild(previewFilter);
    var myCanvas = document.createElement("CANVAS");
    myCanvas.setAttribute("class", "toCustomize");
    myCanvas.setAttribute("width", 500);
    myCanvas.setAttribute("height", 375);


    // var form = document.createElement("FORM");
    // form.setAttribute("method", "POST");

    // var newShootBtn = document.createElement("BUTTON");
    // newShootBtn.setAttribute("class", "myBtn");
    // newShootBtn.setAttribute("type", "submit");
    // newShootBtn.setAttribute("name", "newShoot");
    // newShootBtn.innerHTML = "Take a new picture !";

    // var btnBorder = document.createElement("DIV");
    // btnBorder.setAttribute("class", "gradientBorder");

    var ctx = myCanvas.getContext('2d');
    var image = new Image();
    image.src = usrImg;
    console.log(image.src);
    ctx.drawImage(image, 0, 0, myCanvas.width, myCanvas.height);
    // imageDataURL = myCanvas.toDataURL("image/png");
    polaBorder.appendChild(myCanvas);

    var uploadForm = document.getElementById("uploadImage");
    uploadForm.remove();


    // document.getElementById("shootBtn").setAttribute("value", imageDataURL);
    // btnBorder.appendChild(newShootBtn);
    // form.appendChild(btnBorder);
    // document.getElementById("videoBox").appendChild(myCanvas);
    // document.getElementById("pictureBox").appendChild(form);
    // document.getElementById("videoBox").appendChild(form);
    // document.getElementById("videoBox").appendChild(frame);


    // var videoDisplay = document.getElementById("video");
    // videoDisplay.parentElement.removeChild(videoDisplay);

    // var takePictureBtn = document.getElementById("takePictureBtn");
    // takePictureBtn.parentElement.removeChild(takePictureBtn);

    // var saveBtn = document.getElementById("saveBtn");
    // saveBtn.disabled = false;
    // var usrShootIn = document.getElementById("usrShootIn");
    // usrShootIn.setAttribute("value", imageDataURL);

} */
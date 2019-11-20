navigator.getUserMedia = navigator.getUserMedia
    || navigator.webkitGetUserMedia
    || navigator.mozGetUserMedia
    || navigator.msGetUserMedia;

window.URL = window.URL
    || window.webkitURL;

var canvas, video;

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
    myCanvas.setAttribute("width", 500)
    myCanvas.setAttribute("height", 375)

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

    document.getElementById("shootBtn").setAttribute("value", imageDataURL);
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

    // document.getElementById("sendUsrPicture").submit();



    // console.log("imageDataURL = " + imageDataURL);

    // document.getElementById('snapshot_div').style.display = 'block';
    // document.getElementById('snapshot_img').src = imageDataURL;
    // document.getElementById('snapshot_input').value = imageDataURL;
    // document.getElementById('img_form').style.display = 'none';
}
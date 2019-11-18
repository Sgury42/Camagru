    navigator.getUserMedia = navigator.getUserMedia
    || navigator.webkitGetUserMedia
    || navigator.mozGetUserMedia
    || navigator.msGetUserMedia;
    window.URL = window.URL
    || window.webkitURL;

    var canvas, video;
    navigator.getUserMedia({video: true}, function(localMediaStream) {
        video = document.querySelector('video');
        window.stream = localMediaStream;
    try {
        video.srcObject = localMediaStream;
    } catch (error) {
        video.src = window.URL.createObjectURL(localMediaStream);
    }
    }, function(error) {
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

var i = 0;
// canvasUrlList = [];

function takePicture()
{
    i += 1;
    if (i <= 4) {
        var frame = document.createElement("DIV");
        frame.setAttribute("class", "littlePolaBorder");

        var myCanvas = document.createElement("CANVAS");
        myCanvas.setAttribute("class", "myCanvas");
        myCanvas.setAttribute("width", 500)
        myCanvas.setAttribute("height", 375)

        var form = document.createElement("FORM");
        form.setAttribute("method", "POST");

        var customBtn = document.createElement("BUTTON");
        customBtn.setAttribute("class", "customizeButton");
        // customBtn.setAttribute("onclick", "customPicture()");
        customBtn.setAttribute("type", "submit");
        customBtn.setAttribute("name", "shootToCustom");
        customBtn.innerHTML = "Customize !";
        // form.appendChild(customBtn);

        var btnBorder = document.createElement("DIV");
        btnBorder.setAttribute("class", "gradientBorder");
        // btnBorder.appendChild(form);

        var ctx = myCanvas.getContext('2d');
        ctx.drawImage(video, 0,0, myCanvas.width, myCanvas.height);
        imageDataURL = myCanvas.toDataURL("image/png");
        customBtn.setAttribute("value", imageDataURL);
        btnBorder.appendChild(customBtn);
        form.appendChild(btnBorder);
        frame.appendChild(myCanvas);
        frame.appendChild(form);
        document.getElementById("topBox").appendChild(frame);

    
        // console.log("imageDataURL = " + imageDataURL);

    // document.getElementById('snapshot_div').style.display = 'block';
    // document.getElementById('snapshot_img').src = imageDataURL;
    // document.getElementById('snapshot_input').value = imageDataURL;
    // document.getElementById('img_form').style.display = 'none';
    }
    if (i > 3) {
        document.getElementById("takePictureBtn").style.display = "none";
        return ;
    }
}
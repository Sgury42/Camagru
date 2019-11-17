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

function takePicture() {
    if (i > 3) {
        document.getElementById("takePictureBtn").style.display = "none";
        return ;
    } else {
        i += 1;
        var frame = document.createElement("DIV");
        frame.setAttribute("class", "littlePolaBorder");
        var myCanvas = document.createElement("CANVAS");
        myCanvas.setAttribute("id", "myCanvas")

        // canvas = document.getElementById("canvas");
        var ctx = myCanvas.getContext('2d');
        ctx.drawImage(video, 0,0, myCanvas.width, myCanvas.height);
        frame.appendChild(myCanvas);
        document.getElementById("topBox").appendChild(frame);

    
        imageDataURL = myCanvas.toDataURL('image/png');
        // console.log("imageDataURL = " + imageDataURL);

    // document.getElementById('snapshot_div').style.display = 'block';
    // document.getElementById('snapshot_img').src = imageDataURL;
    // document.getElementById('snapshot_input').value = imageDataURL;
    // document.getElementById('img_form').style.display = 'none';
    }
}
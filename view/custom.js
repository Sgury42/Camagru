dynamsoft.dcsEnv.init("videoContainer", "imageContainer", onInitSuccess, onInitFailure);
function onInitSuccess(videoViewerId, imageViewerId) {
    dcsObject = dynamsoft.dcsEnv.getObject(videoViewerId);
    dcsObject.camera.playVideo();
}

function acquireImage()
{
    if (dcsObject) {
        dcsObject.camera.captureImage("imageContainer");
    }
}
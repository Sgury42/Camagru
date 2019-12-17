// window.onbeforeunload = function() {
//     // this.alert("")
// }
var filterSelected;
var preview = document.getElementById("preview");
var saveBtn = document.getElementById("saveBtn");
var filterIn = document.getElementById("filterIn");

if (saveBtn) {
    saveBtn.disabled = true;
}

if (preview) {
    preview.style.display = "none";
}

// if (document.getElementById("uploadBtn")) {
//     var btn = document.getElementById("uploadBtn");
//     btn.disabled = true;
// }
if (document.getElementById("shootBtn")) {
    var btn = document.getElementById("shootBtn");
    btn.disabled = true;
}
if (document.getElementById("usrPicture")) {
    var usrPicture = document.getElementById("usrPicture");
}

function selectFilter(filter)
{
    console.log(preview);
    if (!filterSelected) {
        filter.style.border = "5px solid white";
    }
    else if (filter != filterSelected) {
        filterSelected.style.border = "none";
        filter.style.border = "5px solid white";
    }
    filterSelected = filter;
    if (btn) {
        btn.disabled = false;
    }
    if (usrPicture) {
        preview.style.width = usrPicture.offsetWidth;
        preview.style.height = usrPicture.offsetHeight;
        var polaBorder = document.getElementById("videoBox");
        var marginSides = (polaBorder.offsetWidth - usrPicture.offsetWidth) / 2;
        preview.style.margin = "30px "+ marginSides +"px";
    }
    if (saveBtn.disabled == true && usrPicture) {
        saveBtn.disabled = false;
        var dataToSend = document.getElementById("usrShootIn");
        var base64 = usrPicture.src;
        dataToSend.setAttribute("value", base64);
    }
    // btn.setAttribute("data-value", filter);
    preview.setAttribute("src", filter["src"]);
    preview.style.display = "block";

    filterIn.setAttribute("value", filter["src"]);

}
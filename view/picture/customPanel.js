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

if (document.getElementById("uploadBtn")) {
    var btn = document.getElementById("uploadBtn");
    btn.disabled = true;
}
else if (document.getElementById("shootBtn")) {
    var btn = document.getElementById("shootBtn");
    btn.disabled = true;
}

function selectFilter(filter)
{
    if (!filterSelected) {
        filter.style.border = "5px solid white";
    }
    else if (filter != filterSelected) {
        filterSelected.style.border = "none";
        filter.style.border = "5px solid white";
    }
    filterSelected = filter;
    btn.disabled = false;
    // btn.setAttribute("data-value", filter);
    preview.setAttribute("src", filter["src"]);
    preview.style.display = "block";

    filterIn.setAttribute("value", filter["src"]);

}

function showForm(id)
{
    document.getElementById(id).style.display = "flex";
}
function hideForm(id)
{
    document.getElementById(id).style.display = "none";
}
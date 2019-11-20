// window.onbeforeunload = function() {
//     // this.alert("")
// }
var filterSelected;

if (document.getElementById("uploadBtn")) {
    var btn = document.getElementById("uploadBtn");
}
else if (document.getElementById("shootBtn")) {
    var btn = document.getElementById("shootBtn");
}

btn.disabled = true;


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
    btn.setAttribute("data-value", filter);
}
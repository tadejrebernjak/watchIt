window.onload = function() {
    document.getElementById("search-button").addEventListener("click", search);
}

function menuHover(icon) {
    icon.src = "media/images/menu-hover.png";
}

function menuHoverRelease(icon) {
    icon.src = "media/images/menu.png";
}

function search() {
    let query = document.getElementById("search-text").value;

    if (query != "") {
        let url = "search.php?q=" + query + "&t=all&s=popular";
        window.location.replace(url);
    }
}
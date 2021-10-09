window.onload = function() {
    document.getElementById("search-button").addEventListener("click", search);

    let url_string = window.location.href;
    let url = new URL(url_string);
    let query = url.searchParams.get("q");
    let queryType = url.searchParams.get("t");
    let sort = url.searchParams.get("s");

    document.getElementById("search-text").value = query;

    if (queryType == "all") {
        document.getElementById("all-button").classList.add("active");
    }
    else if (queryType == "videos") {
        document.getElementById("videos-button").classList.add("active");
    }
    else if (queryType == "channels") {
        document.getElementById("channels-button").classList.add("active");
    }
    else if (queryType == "uploaders") {
        document.getElementById("uploaders-button").classList.add("active");
    }

    if (sort == "popular") {
        document.getElementById("popular-button").classList.add("active");
    }
    else if (sort == "recent") {
        document.getElementById("recent-button").classList.add("active");
    }
}
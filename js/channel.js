document.getElementById("recent-arrow-right").addEventListener("click", (evt) => recentScrollRight("recent"));
document.getElementById("recent-arrow-left").addEventListener("click", (evt) => recentScrollLeft("recent"));
document.getElementById("popular-arrow-right").addEventListener("click", (evt) => recentScrollRight("popular"));
document.getElementById("popular-arrow-left").addEventListener("click", (evt) => recentScrollLeft("popular"));

let subButtonExists = !!document.getElementById("sub-button");
let unsubButtonExists = !!document.getElementById("unsub-button");

if (subButtonExists) {
    document.getElementById("sub-button").addEventListener("click", subscribe);
}

if (unsubButtonExists) {
    document.getElementById("unsub-button").addEventListener("click", unsubscribe);
}

window.onload = function() {
    document.getElementById("search-button").addEventListener("click", search);
    checkArrows;
} 

var checkingArrows;
window.onresize = function(){
    clearTimeout(checkingArrows);
    checkingArrows = setTimeout(checkArrows, 500);
};

function checkArrows() {
    let recentVideos = document.getElementById("recent-videos");
    let recentContainer = document.getElementById("recent-container");
    let popularVideos = document.getElementById("popular-videos");
    let popularContainer = document.getElementById("popular-container");

    let videosLength = recentVideos.scrollWidth;
    let contaierWidth = recentContainer.offsetWidth;

    if (contaierWidth > videosLength) {
        document.getElementById("recent-arrow-right").style.visibility = "hidden";
    }
    else {
        document.getElementById("recent-arrow-right").style.visibility = "visible";
    }

    videosLength = popularVideos.scrollWidth;
    contaierWidth = popularContainer.offsetWidth;

    if (contaierWidth > videosLength) {
        document.getElementById("popular-arrow-right").style.visibility = "hidden";
    }
    else {
        document.getElementById("popular-arrow-right").style.visibility = "visible";
    }
}


function recentScrollRight(type) {
    let horizontalVideos = document.getElementById(type + "-videos");
    let horizontalContainer = document.getElementById(type + "-container");
    let otherArrow = document.getElementById(type + "-arrow-left");
    let thisArrow = document.getElementById(type + "-arrow-right");

    let horizontalVideosLength = horizontalVideos.scrollWidth;
    let contaierWidth = horizontalContainer.offsetWidth;

    let scrollDistance = horizontalVideosLength - contaierWidth;
    let offset = getTranslateX(horizontalVideos);
    let scrolled = Math.abs(offset);

    if ((scrollDistance - scrolled) > 500) {
        horizontalVideos.style.transform = "translateX(-" + (scrolled + 500) + "px)";
    }
    else {
        horizontalVideos.style.transform = "translateX(-" + scrollDistance + "px)";
        thisArrow.style.visibility = "hidden";
    }

    if (otherArrow.style.visibility == "" || otherArrow.style.visibility == "hidden") {
        otherArrow.style.visibility = "visible";
    }
}

function recentScrollLeft(type) {
    let horizontalVideos = document.getElementById(type + "-videos");
    let otherArrow = document.getElementById(type + "-arrow-right");
    let thisArrow = document.getElementById(type + "-arrow-left");

    let offset = getTranslateX(horizontalVideos);
    let scrolled = Math.abs(offset);

    if ((scrolled) > 500) {
        horizontalVideos.style.transform = "translateX(-" + (scrolled - 500) + "px)";
    }
    else {
        horizontalVideos.style.transform = "translateX(-" + 0 + "px)";
        thisArrow.style.visibility = "hidden";
    }

    if (otherArrow.style.visibility == "" || otherArrow.style.visibility == "hidden") {
        otherArrow.style.visibility = "visible";
    }
}

function getTranslateX(myElement) {
    var style = window.getComputedStyle(myElement);
    var matrix = new WebKitCSSMatrix(style.transform);

    return matrix.m41;
}

function changeTab(button, page)
{
	var i, tabcontent;

	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) 
	{
		tabcontent[i].style.display = "none";
	}

	document.getElementById(page).style.display = "block";

    tabs = document.getElementsByClassName("tabs");
    for (i = 0; i < tabs.length; i++) 
	{
		tabs[i].classList.remove("active");
	}

    button.classList.add("active");
}

function subscribe() {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let channelid = url.searchParams.get("id");

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "insert_subscription.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`channelid=${channelid}`);
    xhttp.onload = function() {
        window.location.reload();
	}
}

function unsubscribe() {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let channelid = url.searchParams.get("id");

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "delete_subscription.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`channelid=${channelid}`);
    xhttp.onload = function() {
        window.location.reload();
	}
}
removeButton = document.getElementById("remove-button");
removeButton.addEventListener("click", confirm);

var t;

function confirm() {
    removeButton.removeEventListener("click", confirm);

    removeButton.innerHTML = "Are you sure?";
    removeButton.addEventListener("click", deleteVideo);
    t = setTimeout(() => {
        removeButton.innerHTML = "Remove video";
        removeButton.removeEventListener("click", deleteVideo);
        removeButton.addEventListener("click", confirm);
    }, 5000);
}

function deleteVideo() {
    let videoID = document.getElementById("videoid").value;

    clearTimeout(t);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "delete_video.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`videoid=${videoID}`);

    xhttp.onload = function() {
        window.history.back();
    }
}
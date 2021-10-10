pfpInput = document.getElementById("pfp-file");
pfp = document.getElementById("pfp");
bannerInput = document.getElementById("banner-file");
banner = document.getElementById("banner");

pfpInput.onchange = evt => {
    const [file] = pfpInput.files;
    if (file) {
      pfp.src = URL.createObjectURL(file);
    }
}

bannerInput.onchange = evt => {
    const [file] = bannerInput.files;
    if (file) {
      banner.src = URL.createObjectURL(file);
    }
}

removeButton = document.getElementById("remove-button");
removeButton.addEventListener("click", confirm);

var t;

function confirm() {
    removeButton.removeEventListener("click", confirm);

    removeButton.innerHTML = "Are you sure?";
    removeButton.addEventListener("click", deleteUser);
    t = setTimeout(() => {
        removeButton.innerHTML = "Remove video";
        removeButton.removeEventListener("click", deleteUser);
        removeButton.addEventListener("click", confirm);
    }, 5000);
}

function deleteUser() {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let userID = url.searchParams.get("id");

    clearTimeout(t);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "delete_user.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`userid=${userID}`);

    xhttp.onload = function() {
        window.history.back();
    }
}
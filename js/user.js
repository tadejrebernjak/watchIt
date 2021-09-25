document.getElementById("username-change-button").addEventListener("click", usernameUpdate);
document.getElementById("password-change-button").addEventListener("click", passwordUpdate);

function usernameUpdate() {
    let username = document.getElementById("username-change").value;
    let userid = document.getElementById("user-id").value;
    let response = document.getElementById("username-response");

    if (username == "") {
        response.innerHTML = "Please write a username";
    }
    else {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "update_username.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`userid=${userid}&username=${username}`);

        xhttp.onload = function() {
            if (this.responseText != 1) {
                response.innerHTML = this.responseText;
            }
            else {
                window.location.reload();
            }
        }
    }
}

function passwordUpdate() {
    let currentPassword = document.getElementById("current-password").value;
    let newPassword = document.getElementById("new-password").value;
    let newPasswordCheck = document.getElementById("new-password-repeat").value;
    let userid = document.getElementById("user-id").value;
    let response = document.getElementById("password-response");

    if (currentPassword == "" || newPassword == "" || newPasswordCheck == "") {
        response.innerHTML = "Please fill in all fields";
    }
    else {
        if (newPassword != newPasswordCheck) {
            response.innerHTML = "Passwords do not match";
        }
        else {
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "update_password.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`userid=${userid}&newpassword=${newPassword}&password=${currentPassword}`);

            xhttp.onload = function() {
                if (this.responseText != 1) {
                    response.innerHTML = this.responseText;
                }
                else {
                    response.innerHTML = "Password has been changed";
                }
            }
        }
    }
}
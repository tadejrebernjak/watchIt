document.getElementById("username-change-button").addEventListener("click", usernameUpdate);
document.getElementById("password-change-button").addEventListener("click", passwordUpdate);
document.getElementById("description-change-button").addEventListener("click", descriptionUpdate);

function usernameUpdate() {
    let usernameField = document.getElementById("username-change");
    let username = usernameField.value;
    let usernameLength = username.length;
    let response = document.getElementById("username-response");

    if (username == "") {
        response.innerHTML = "<p class='error-text align-left'>Please write a username</p>";
        usernameField.style.border = "1px solid rgb(221, 18, 18)";

        setTimeout(function() {
            response.innerHTML = "";
            usernameField.style.border = "1px solid rgb(201, 201, 201)";
        }, 3000);
    }
    else {
        if (usernameLength > 15) {
            response.innerHTML = "<p class='error-text align-left'>Maximum username length is 15 characters</p>";
            usernameField.style.border = "1px solid rgb(221, 18, 18)";

            setTimeout(function() {
                response.innerHTML = "";
                usernameField.style.border = "1px solid rgb(201, 201, 201)";
            }, 3000);
        }
        else {
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "update_username.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`username=${username}`);
    
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
}

function passwordUpdate() {
    let currentPasswordField = document.getElementById("current-password");
    let newPasswordField = document.getElementById("new-password");
    let newPasswordCheckField = document.getElementById("new-password-repeat");
    let currentPassword = currentPasswordField.value;
    let newPassword = newPasswordField.value;
    let newPasswordCheck = newPasswordCheckField.value;
    let response = document.getElementById("password-response");

    if (currentPassword == "" || newPassword == "" || newPasswordCheck == "") {
        currentPasswordField.style.border = "1px solid rgb(221, 18, 18)";
        newPasswordField.style.border = "1px solid rgb(221, 18, 18)";
        newPasswordCheckField.style.border = "1px solid rgb(221, 18, 18)";
        response.innerHTML = "<p class='error-text align-left'>Please fill in all fields</p>";

        setTimeout(function() {
            response.innerHTML = "";
            currentPasswordField.style.border = "1px solid rgb(201, 201, 201)";
            newPasswordField.style.border = "1px solid rgb(201, 201, 201)";
            newPasswordCheckField.style.border = "1px solid rgb(201, 201, 201)";
        }, 3000);
    }
    else {
        if (newPassword != newPasswordCheck) {
            newPasswordField.style.border = "1px solid rgb(221, 18, 18)";
            newPasswordCheckField.style.border = "1px solid rgb(221, 18, 18)";
            response.innerHTML = "<p class='error-text align-left'>Passwords do not match</p>";

            setTimeout(function() {
                response.innerHTML = "";
                newPasswordField.style.border = "1px solid rgb(201, 201, 201)";
                newPasswordCheckField.style.border = "1px solid rgb(201, 201, 201)";
            }, 3000);
        }
        else {
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "update_password.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`newpassword=${newPassword}&password=${currentPassword}`);

            xhttp.onload = function() {
                if (this.responseText != 1) {
                    response.innerHTML = this.responseText;
                    currentPasswordField.style.border = "1px solid rgb(221, 18, 18)";

                    setTimeout(function() {
                        response.innerHTML = "";
                        currentPasswordField.style.border = "1px solid rgb(201, 201, 201)";
                    }, 3000);
                }
                else {
                    response.innerHTML = "<p class='success-text align-left'>Password has been changed</p>";

                    document.getElementById("current-password").value = "";
                    document.getElementById("new-password").value = "";
                    document.getElementById("new-password-repeat").value = "";

                    setTimeout(function() {
                        response.innerHTML = "";
                    }, 3000);
                }
            }
        }
    }
}

function descriptionUpdate() {
    let descriptionField = document.getElementById("description");
    let description = descriptionField.value;
    let response = document.getElementById("description-response");

    if (description == "") {
        response.innerHTML = "<p class='error-text align-left'>Description field is empty</p>";
        descriptionField.style.border = "1px solid rgb(221, 18, 18)";

        setTimeout(function() {
            response.innerHTML = "";
            descriptionField.style.border = "1px solid rgb(201, 201, 201)";
        }, 3000);
    }
    else {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "update_channel_description.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`description=${description}`);

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
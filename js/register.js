document.getElementById("register-button").addEventListener("click", registerSubmit);

function registerSubmit() {
    let email = document.getElementById("email").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let passwordRepeat = document.getElementById("password-repeat").value;
    let response = document.getElementById("response");
    if (email == "" || username == "" || password == "" || passwordRepeat == "") {
        response.innerHTML = "<p class='error-text'>Fill in all fields</p>";
    }
    else {
        if (!validateEmail(email)) {
            response.innerHTML = "<p class='error-text'>Email is not in the correct format</p>";
        }
        else {
            if (password != passwordRepeat) {
                response.innerHTML = "<p class='error-text'>Passwords do not match</p>";
            }
            else {
                let xhttp = new XMLHttpRequest();
                xhttp.open("POST", "register_account.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(`email=${email}&username=${username}&password=${password}`);
                xhttp.onload = function() {
                    if (this.responseText != 1) {
                        response.innerHTML = this.responseText;
                    }
                    else {
                        window.location.href = 'login.php';
                    }
                }
            }
        }
    }
}
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
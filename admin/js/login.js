document.getElementById("login-button").addEventListener("click", loginSubmit);

function loginSubmit() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let response = document.getElementById("response");
    if (username == "" || password == "") {
		response.innerHTML = "<p class='error-text'>Please fill in all fields</p>";

        setTimeout(() => {
            response.innerHTML = "";
        }, 3000);
	}
    else {
        let xhttp = new XMLHttpRequest();
		xhttp.open("POST", "check_login.php");
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(`username=${username}&password=${password}`);
        xhttp.onload = function()
		{
			if (this.responseText != "1") {
				response.innerHTML = this.responseText;

                setTimeout(() => {
                    response.innerHTML = "";
                }, 3000);
			}
			else {
				window.location.href = 'index.php';
			}
		}
    }
}
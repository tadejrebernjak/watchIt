document.getElementById("login-button").addEventListener("click", loginSubmit);

function loginSubmit() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let response = document.getElementById("response");
    if (email == "" || password == "") {
		response.innerHTML = "<p class='error-text'>Please fill in all fields</p>";
	}
    else {
        let xhttp = new XMLHttpRequest();
		xhttp.open("POST", "check_login.php");
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(`email=${email}&password=${password}`);
        xhttp.onload = function()
		{
			if (this.responseText != "1") {
				document.getElementById("response").innerHTML = this.responseText;
			}
			else {
				window.location.href = 'index.php';
			}
		}
    }
}
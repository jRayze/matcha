var lastCheck = new Date().getTime();

const lastName = document.getElementById('inputLastName');
const firstName = document.getElementById('inputFirstName');
const username = document.getElementById('inputUsername');
const email = document.getElementById('inputEmail');
const password = document.getElementById('inputPassword');

lastName.addEventListener('focusout', (event) => {
    checkInputs();
});

firstName.addEventListener('focusout', (event) => {
    checkInputs();
});

username.addEventListener('focusout', (event) => {
    checkInputs();
});

email.addEventListener('focusout', (event) => {
    checkInputs();
});

password.addEventListener('focusout', (event) => {
    checkInputs();
});

password.addEventListener('input', (event) => {
    checkInputs();
});

function checkInputs() {
    var getUrl = "/php/account/check_register_form.php?lastname=" + lastName.value;
    getUrl += "&firstname=" + firstName.value;
    getUrl += "&username=" + username.value;
    getUrl += "&email=" + email.value;
    getUrl += "&password=" + password.value;

    if (new Date().getTime() - lastCheck > 300) {
        lastCheck = new Date().getTime();

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var result = JSON.parse(this.responseText);
                console.log(result);
                if (result.valid) {
                    document.getElementById("submitButton").disabled = false;
                } else {
                    document.getElementById("submitButton").disabled = true;
                }
            }
        };
        xhttp.open("GET", getUrl, true);
        xhttp.send();
    }
}
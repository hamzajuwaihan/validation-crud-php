
function Registervalidate() {

    const emailField = document.getElementById("inputEmail");
    const passField = document.getElementById("inputPassword");
    const confirmPassField = document.getElementById("inputPasswordConfirm");
    let inputFirstName = document.getElementById("inputFirstName")
    let inputMiddleName = document.getElementById("inputMiddleName")
    let inputLastName = document.getElementById("inputLastName")
    let inputFamilyName = document.getElementById("inputFamilyName")
    if (inputFirstName.value == '') {
        document.getElementById("fname-error").textContent =
            "The first name field is required.";

        return false;
    } else {
        document.getElementById("fname-error").textContent =
            "";
    }
    if (inputMiddleName.value == '') {
        document.getElementById("m-name-error").textContent =
            "The first name field is required.";
        return false;
    } else {
        document.getElementById("m-name-error").textContent =
            "";
    }
    if (inputLastName.value == '') {
        document.getElementById("l-error").textContent =
            "The last name field is required.";
        return false;
    } else {
        document.getElementById("l-error").textContent =
            "";
    }
    if (inputFamilyName.value == '') {
        document.getElementById("fam-name-error").textContent =
            "The family name field is required.";
        return false;
    } else {
        document.getElementById("fam-name-error").textContent =
            "";
    }

    let inputPhone = document.getElementById('inputphone');
    if (typeof inputPhone.value != "number" && inputPhone.value.length !== 14) {
        document.getElementById('phone-error').textContent = "phone field must be a number and contains 14 numbers";
        document.getElementById("phone-error").style.color = "red";
        console.log(inputPhone);
        return false;
    }else{
        document.getElementById('phone-error').textContent = "";
        console.log(inputPhone);
    }

    if (emailField.value == null || emailField.value == "") {
        document.getElementById("email-error").textContent =
            "The email field is required.";
    } else if (
        !emailField.value.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        )
    ) {
        document.getElementById("email-error").textContent =
            "The email must be a valid email address.";
        return false;
    } else {
        document.getElementById("email-error").textContent = "";
    }
    if (passField.value == "" || passField.value == null) {
        document.getElementById("password-error").textContent =
            "The password field is required.";
        return false;
    } else if (passField.value.length < 6) {
        document.getElementById("password-error").textContent =
            "The password must be at least 6 characters.";
        return false;
    } else if (passField.value.length > 18) {
        document.getElementById("password-error").textContent =
            "The password may not be greater than 18 characters.";
        return false;
    } else {
        document.getElementById("password-error").textContent = "";
    }
    document.getElementById("password-error").style.color = "red";
    if (confirmPassField.value == "" || confirmPassField.value == null) {
        document.getElementById("confirm-password-error").textContent =
            "The password field is required.";
        return false;
    } else if (confirmPassField.value !== passField.value) {
        document.getElementById("confirm-password-error").textContent =
            "Passwords do not match";
        return false;
    }
    document.getElementById("confirm-password-error").style.color = "red";




}

function validateLogin(){
    const emailField = document.getElementById("inputEmail");
    const passField = document.getElementById("inputPassword");
    if (emailField.value == null || emailField.value == "") {
        document.getElementById("email-error").textContent =
            "The email field is required.";
    } else if (
        !emailField.value.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        )
    ) {
        document.getElementById("email-error").textContent =
            "The email must be a valid email address.";
        return false;
    } else {
        document.getElementById("email-error").textContent = "";
    }
    if (passField.value == "" || passField.value == null) {
        document.getElementById("password-error").textContent =
            "The password field is required.";
        return false;
    } else if (passField.value.length < 6) {
        document.getElementById("password-error").textContent =
            "The password must be at least 6 characters.";
        return false;
    } else if (passField.value.length > 18) {
        document.getElementById("password-error").textContent =
            "The password may not be greater than 18 characters.";
        return false;
    } else {
        document.getElementById("password-error").textContent = "";
    }
    document.getElementById("password-error").style.color = "red";
}